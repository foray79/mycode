import numpy as np
import doctest2
import matplotlib.pyplot as plt

class Perceptron():
    def __init__(self, num_featues):
        self.num_featues = num_featues
        self.weights = np.zeros((num_featues, 1) ,dtype=float)
        self.bias = np.zeros(1, dtype=float)

    def forward(self,x):
        linear = np.dot(x,self.weights)+self.bias
        perceptron = np.where(linear>0.,1,0)
        return perceptron

    def backword(self,x,y):
        predictions = self.forward(x)
        error = y-predictions

        return error

    def train(self,x,y,epochs):
        for e in range(epochs) :
            for i in range(y.shape[0]):
                error = self.backword(x[i].reshape(1,self.num_featues), y[i].reshape(-1))
                self.weights += (error * x[i]).reshape(self.num_featues,1)
                self.bias +=error.reshape(1)

    def evaluate(self,x,y):
        predictions = self.forward(x).reshape(-1)
        accuracy = np.sum(predictions == y )/ y.shape[0]
        return accuracy


#data set
import sklearn.datasets as dt
import sys
data = dt.make_classification(n_samples=100 , n_features=2, n_repeated=0, n_classes=2, n_redundant=0)


X,y = data[0], data[1]
print("==deep learning==")


#y.y.astype(int)

shuffle_idx = np.arange(y.shape[0])
shuffle_rng = np.random.RandomState(123)
shuffle_rng.shuffle(shuffle_idx)

#print(np.bincount(y))

X, y = X[shuffle_idx], y[shuffle_idx]

X_train , y_train  = X[shuffle_idx[:70]] , y[shuffle_idx[:70]]

X_test , y_test  = X[shuffle_idx[70:]] , y[shuffle_idx[70:]]

xmean , xdev = X_train.mean(axis=0), X_train.std(axis=0)
ymean , ydev = y_train.mean(axis=0), y_train.std(axis=0)

X1_train = (X_train-xmean)/xdev
X_test = (X_test-xmean)/xdev

Y_train = (y_train-ymean)/ydev
Y_test = (y_test-ymean)/ydev

set0 =  np.zeros(X_train.shape)
set1 = np.ones(X1_train.shape)

#fig, ax = plt.subplots(1,2,sharex=True)

plt.scatter(X_train,set0 , label='row data', marker='o')
plt.scatter(X1_train, set1 , label='normalize data', marker='s')

plt.plot([0,0],[2,2])
#ax[1].plot([x0_min,x0_max],[x_min,x_max])
plt.legend()
plt.show()
sys.exit(0)
#training
ppn = Perceptron(num_featues=2)
ppn.train(X_train,y_train,epochs=5)
print("Model paameters : \n")
print("\t Weight : %s" %ppn.weights)
print("\t Bias : %s" %ppn.bias)

#Evaluate
train_acc = ppn.evaluate(X_train, Y_train)
print("Train set accuracy: %.2f%%" %(train_acc*100))

test_acc = ppn.evaluate(X_test, Y_test)
print("Test set accuracy: %.2f%%" %(test_acc*100))

w, b = ppn.weights  , ppn.bias

x0_min =-2
x_min = ((-(w[0] * x0_min)-b[0])/w[1])

x0_max =2
x_max = ((-(w[0] * x0_max)-b[0])/w[1])

print(x_min)
print(x_max)
fig , ax = plt.subplots(1,2,sharex=True, figsize=(7,3))
ax[0].scatter(X_train[y_train==0,0], X_train[y_train==0,1], label='class 0', marker='o')
ax[0].scatter(X_train[y_train==1,0], X_train[y_train==1,1], label='class 1', marker='s')
ax[0].legend(loc="upper left")

ax[1].plot([x0_min,x0_max],[x_min,x_max])
ax[1].scatter(X_train[y_train==0,0], X_train[y_train==0,1], label='class 0', marker='o')
ax[1].scatter(X_train[y_train==1,0], X_train[y_train==1,1], label='class 1', marker='s')
ax[1].legend(loc="upper left")

plt.show()