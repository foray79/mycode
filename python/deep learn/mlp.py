import numpy as np
import doctest2
import matplotlib.pyplot as plt



def AND(x1,x2):
    """this is example doctest cases.
    >>> AND(0,0)
    0
    >>> AND(0,1)
    0
    >>> AND(1,0)
    0
    >>> AND(1,1)
    1
    """

    x=np.array([x1,x2])
    w=np.array([0.5, 0.5])
    b=-0.7
    tmp = np.sum(x*w) + b

    if tmp<=0 :
        return 0
    return 1


doctest2.run_docstring_examples(AND,globals(),False,__name__)


def NAND(x1,x2):
    """this is example doctest cases.
    >>> NAND(0,0)
    1
    >>> NAND(0,1)
    1
    >>> NAND(1,0)
    1
    >>> NAND(1,1)
    0
    """

    x=np.array([x1,x2])
    w=np.array([-0.5, -0.5])
    b=0.7
    tmp = np.sum(x*w) + b

    if tmp<=0 :
        return 0
    return 1

doctest2.run_docstring_examples(NAND,globals(),False,__name__)

def OR(x1,x2):
    """this is example doctest cases.
    >>> OR(0,0)
    0
    >>> OR(0,1)
    1
    >>> OR(1,0)
    1
    >>> OR(1,1)
    1
    """

    x=np.array([x1,x2])
    w=np.array([0.5, 0.5])
    b=-0.2
    tmp = np.sum(x*w) + b

    if tmp<=0 :
        return 0
    return 1

doctest2.run_docstring_examples(OR,globals(),False,__name__)


def XOR(x1,x2):
    """ this is example doctest cases.
    >>> XOR(0,0)
    0
    >>> XOR(0,1)
    1
    >>> XOR(1,0)
    1
    >>> XOR(1,1)
    0
    """

    s1 = NAND(x1,x2)
    s2 = OR(x1,x2)
    y = AND(s1,s2)

    return y

doctest2.run_docstring_examples(XOR,globals(),False,__name__)


#mlp
import sklearn.datasets as dt

data = dt.make_classification(n_samples=100 , n_features=2, n_repeated=0, n_classes=2, n_redundant=0)

X,y = data[0], data[1]

print(np.bincount(y))
print(X.shape)
print(y.shape)
#y.y.astype(int)

shuffle_idx = np.arange(y.shape[0])
shuffle_rng = np.random.RandomState(123)
shuffle_rng.shuffle(shuffle_idx)

X, y = X[shuffle_idx], y[shuffle_idx]

X_train , y_train  = X[shuffle_idx[:70]] , y[shuffle_idx[:70]]

X_test , y_test  = X[shuffle_idx[70:]] , y[shuffle_idx[70:]]

mu , sigma = X_train.mean(axis=0), X_train.std(axis=0)
X_train = (X_train-mu)/sigma
X_test = (X_test-mu)/sigma

"""
plt.scatter(X_train[y_train==0,0], X_train[y_train==0,1], label='class 0', marker='o')
plt.scatter(X_train[y_train==1,0], X_train[y_train==1,1], label='class 1', marker='s')
plt.title("Training data")
plt.xlabel('feature 1')
plt.ylabel('feature 2')
plt.xlim([-3,3])
plt.ylim([-3,3])
plt.legend()
plt.show()
"""

def sigmod(x) :
    return 1/(1+np.exp(-x))

def relu(x):
    return np.maximum(0,x)


def tanh(x):
    return (np.exp(x) - np.exp(-x))/(np.exp(x) + np.exp(-x))

X = np.arange(-5.0, 5.0, 0.1 , dtype=np.float32)
X1 = np.round(X,4)
Y = sigmod(X)

print(X1)
#print(Y)

plt.plot(X,Y)
plt.ylim([-0.1,1.1])
plt.show()

