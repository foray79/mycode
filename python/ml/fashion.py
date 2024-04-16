import tensorflow as tf
from tensorflow import keras
from keras import layers
import matplotlib.pyplot as plt
import numpy as np

#Fashion-MNIST 데이터셋 불러오기
(x_train, y_train), (x_test, y_test) = keras.datasets.fashion_mnist.load_data()

print(x_train.shape)

print(y_train.shape)

print(x_test.shape)

#데이터 시각화하기
class_names = [
    "T-shirt/top",
    "Trouser",
    "Pullover",
    "Dress",
    "Coat",
    "Sandal",
    "Shirt",
    "Sneaker",
    "Bag",
    "Ankle boot",
]

fig, axs = plt.subplots(5, 5, figsize=(10, 10))
axs = axs.ravel()

# Loop through the first 25 images and plot them
for i in range(25):
    # Plot the image
    axs[i].imshow(x_train[i])
    axs[i].set_title(class_names[y_train[i]])
    axs[i].axis("off")

# Show the plot
plt.show()

#딥러닝 모델 정의

# 0~1 사이의 값으로 normalize 합니다.
x_train = x_train.astype("float32") / 255.0
x_test = x_test.astype("float32") / 255.0

# data 형태 바꾸기.. 28*28 형태의 데이터를.. 784 형태의 벡터로 바꿔줍니다.
print(x_train.shape, x_test.shape)
x_train = x_train.reshape(-1,784)
x_test = x_test.reshape(-1,784)
print(x_train.shape, x_test.shape)


# Sequential 모델 정의
model = keras.Sequential([
    keras.Input(shape=(784)), # mnist image는 28*28=784 형태
    layers.Dense(256, activation="relu"),
    layers.Dense(128, activation="relu"),
    layers.Dense(10, activation="softmax"),
])

# 모델 컴파일
model.compile(
    optimizer="adam",
    loss="sparse_categorical_crossentropy", # label이 one-hot 벡터가 아닌 일반 정수형일 때 내부적으로 one-hot vector로 바꿔서 계산해줌.
    metrics=["accuracy"],
)

# 모델 학습
history = model.fit(
    x_train,
    y_train,
    batch_size=64,
    epochs=5,
)

#모델 평가
# 모델 예측값 확인
predict = np.round(model.predict(x_test[0].reshape(-1, 784)), 3)
# 모델이 예측한 lable
predict_label = np.argmax(predict, axis=1)
class_names[predict_label[0]]
# test set으로 모델 평가
test_scores = model.evaluate(x_test.reshape(-1, 784), y_test)
print("Test loss:", test_scores[0])
print("Test accuracy:", test_scores[1])