import tensorflow as tf
from tensorflow import keras
import pandas as pd
from tensorflow.keras import layers

import matplotlib.pyplot as plt
import sys
import numpy as np

x = np.linspace(0, 50, 50)
y = np.linspace(0, 50, 50)

# Adding noise to the random linear data
x += np.random.uniform(-4, 4, 50)
y += np.random.uniform(-4, 4, 50)
n = len(x)
"""
# Plot of Training Data
plt.scatter(x, y)
plt.xlabel('x')
plt.ylabel('y')
plt.title("Training Data")
plt.show()
"""

W = tf.Variable(np.random.randn(), name = "W")
b = tf.Variable(np.random.randn(), name = "b")
learning_rate = 0.01
training_epochs = 1000

# Hypothesis
y_pred = tf.add(tf.multiply(x, W), b)
cost = tf.reduce_sum(tf.pow(y_pred-y, 2)) / (2 * n)

# Gradient Descent Optimizer
optimizer = tf.train.GradientDescentOptimizer(learning_rate).minimize(cost)

# Global Variables Initializer
init = tf.global_variables_initializer()
print(y_pred)
print(cost)