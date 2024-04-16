# 로지스틱회귀(이진분류) -경사하강
import matplotlib.pyplot as plt
import pandas as pd
import numpy as np
from tensorflow import keras
from keras import layers

#샘플 데이터 생성
x = np.array([-50,-40,-35,-30,-25,-22,10,25,30,45],dtype=np.float32)
y = np.array([0,0,0,0,0,0,1,1,1,1],dtype=np.float32)

#케라스 모델 생성
# 모델 객체를 생성함과 동시에 w, b를 임의의 숫자로 초기화한다.
model = keras.Sequential([
    layers.Dense(units=1, input_shape=[1], activation='sigmoid')
])

init_w, init_b = model.get_weights()
print(init_w[0])
print(init_b)

plt.scatter(x, y)

# k = np.linspace(-100, 100, 100)
z = 1 / (1 + np.exp(-(init_w[0] * x + init_b)))
plt.plot(x, z, color='red')
plt.title('init Logistic Regression')
plt.show()


# 모델 컴파일 과정
sgd = keras.optimizers.SGD(learning_rate=0.01) # 경사하강법 learnig rate를 0.1로 설정하고
model.compile(optimizer=sgd, loss='binary_crossentropy') # BCE를 비용함수로 설정

# 학습
history = model.fit(x, y, epochs=30)

# 학습된 w, b
w, b = model.get_weights()

print(f"\n\n\n학습된 w: {w}, b: {b}\n\n\n")


plt.scatter(x, y)

# k = np.linspace(-100, 100, 100)
z = 1 / (1 + np.exp(-(w[0] * x + b)))
plt.plot(x, z, color='red')
plt.title('trained Logistic Regression')
plt.show()

#모델을 활용해 새로운 데이터로 합격/불합격 확률을 예측

x_new = np.array(
    [-50,-10, 5, 10, 20],
    dtype=np.float32
)

y_new = np.round(model.predict(x_new), 3)

print(y_new)
