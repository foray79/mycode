from djang.http import httpResponse

def index(request):
    return httpResponse("hello, world. you're at the polls index.")