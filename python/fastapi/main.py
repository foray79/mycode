from typing import Optional
from enum import Enum

from fastapi import Body,FastAPI
from pydantic import BaseModel
import logging as log

log.basicConfig(filename='./log.txt', level=log.DEBUG)

log.info("some info here~!!")
log.warning("Some Warning Here!")
log.error("Some ERROR Here!")
class Item (BaseModel):
    name: str
    description: Optional[str] = None
    price: float
    tax: Optional[float] = None

class ModelName(str,Enum):
    alexnet="alexnet"
    resnet = "resnet"
    lenet = "lenet"

app = FastAPI()

@app.get("/models/{model_name}")
async def get_model(model_name:ModelName):
    log.info("get_model :"+model_name)
    if model_name == ModelName.alexnet :
        return {"model_name":model_name,"message": "Deep Learning FTW!"}
    if model_name.value == "lenet" :
        return {"model_name":model_name,"message": "LeCNN all the images"}
    return {"model_name": model_name, "message": "Have some residuals"}

@app.get("/")
async def root():
    return {"hello":"world~!"}

@app.post("/items/")
async def create_item(item:Item):
    return item

@app.put("/items/{item_id}") 
async def update_item(item_id, item: Item ): 
    results = {"item_id": item_id, "item": item}
    return results 

fake_items_db = [{"item_name": "Foo"}, {"item_name": "Bar"}, {"item_name": "Baz"}]

@app.get("/items/{item_id}") 
async def read_item(item_id:int,skip:int=0,limit:int=10):
    return {"item_id" : item_id, "item" : fake_items_db[skip : skip + limit] }
