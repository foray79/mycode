# 소프트맥스회귀(다중분류) -경사하강
import matplotlib.pyplot as plt
import pandas as pd
import numpy as np
from tensorflow import keras
from keras import layers

#샘플 데이터 생성
x = np.array([
    [14, 5, 30],
    [16, 6, 45],
    [5, 5, 45],
    [20, 6, 60],
    [10, 7, 55],
    [13, 10, 50],
], dtype=np.float32)

y = np.array([
    [1,0,0], # 말티즈
    [0,1,0], # 푸들
    [0,0,1], # 치와와
    [1,0,0], # 말티즈
    [0,1,0], # 푸들
    [0,0,1], # 치와와
], dtype=np.float32)

#케라스 모델 생성
model = keras.Sequential([
    layers.Dense(units=3, input_shape=[3], activation='softmax')
])

print(model.get_weights())

# 모델 컴파일 과정
sgd = keras.optimizers.SGD(learning_rate=0.01) # 경사하강법 learnig rate를 0.1로 설정하고
model.compile(optimizer=sgd, loss='categorical_crossentropy') # CCE를 비용함수로 설정

# 학습
history = model.fit(x, y, epochs=5)

# loss 시각화
plt.plot(history.history['loss'])
plt.title('Model Loss')
plt.xlabel('Epoch')
plt.ylabel('Loss')
plt.show()


# 새로운 데이터를 통한 label 예측
x_new = np.array([[12, 6, 35], [8, 5, 50]], dtype=np.float32)
y_pred = np.round(model.predict(x_new), 3)

# 모델이 예측한 label print
print(y_pred)