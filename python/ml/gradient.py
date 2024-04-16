#선형회귀- 경사하강
import matplotlib.pyplot as plt
import pandas as pd
import numpy as np
from tensorflow import keras
#from tensorflow.keras import layers
from keras import layers

#샘플 데이터 생성
x= np.array([1,3,5,6,10],dtype=np.float32)
y= np.array([0.5,1,2,1.8,3],dtype=np.float32)

#케라스 모델 생성
model = keras.Sequential([layers.Dense(units=1,input_shape=[1],activation="linear")])

init_w,init_b = model.weights
print(init_w,init_b)

plt.scatter(x, y)
plt.plot(x, init_w[0][0] * x + init_b[0], color='red')
plt.xlabel('x')
plt.ylabel('y')
plt.title('init Linear Regression')
plt.show()

# 모델 컴파일 과정
sgd = keras.optimizers.SGD(learning_rate=0.001) # 경사하강법 learnig rate를 0.001로 설정하고
model.compile(optimizer=sgd, loss='mean_squared_error') # MSE를 비용함수로 설정

# 학습
history = model.fit(x, y, batch_size=1, epochs=10)

# 학습된 w, b
w, b = model.layers[0].get_weights()[0][0][0], model.layers[0].get_weights()[1][0]

print(f"\n\n\n학습된 w: {w}, b: {b}\n\n\n")

# Plot the regression line
plt.scatter(x, y)
plt.plot(x, w * x + b, color='red')
plt.xlabel('x')
plt.ylabel('y')
plt.title('Linear Regression')
plt.show()