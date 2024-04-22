import numpy as np

"""
arr = np.full((3,4,5),3)

print(arr)


arr1 = np.random.randint(-50,50,(4,5))
print(arr1)
arr2= np.sort(arr1,axis=0)
print(arr2)

arr3= np.sort(arr1,axis=None) #오답
print(arr3)


import sys
py_list = [
    np.full(3,8),
    np.array([33,-15,26]),
    np.linspace(17,26,3)
]
print(py_list)
#평균
p1 = np.mean(py_list,axis=1)
print("평균",p1)
#표준편차
p2 = np.std(py_list,axis=1)
print("표준편차",p2)
#중앙값
p3 = np.median(py_list,axis=1)
print("중앙값",p3)
for i in range(3):
    print(p1[i])
sys.exit(0)
arr = []
for i in range(3):
    arr = np.append(p1[i])
    arr = np.append(p2[i])
    arr = np.append(p3[i])
#arr = np.expend(np.expend(p1,p2),p3)
print(arr)



arr =np.arange(2,20,2).reshape((3,3))
print(arr)
#분할
s1 = np.vsplit(arr,3)
print(s1)
#제곱
s2 = np.square(s1)
print(s2)
#차원 줄임
s3 = np.squeeze(s2,axis=1)
print(s3)
#병합
s4 = np.vstack(s3)
print(s4)


#0,30,60,90
arr = np.array([0,30,60,90])

arr_rad = arr * np.pi /180

print(arr)
print(arr_rad)
#sin
sind =np.sin(arr_rad)
#cos
cosd =np.cos(arr_rad)
#tan
tand =np.tan(arr_rad)

listd=[sind,cosd,tand]

for val_list in listd:

print(listd)


#arr = np.zeros((7,7),dtype=int)
#print(arr)
#arr[::2, 1::2] = 1
#arr[1::2, ::2] = 1
#print(arr)

arr = np.eye(3,7,k=1,dtype=int)
print(arr)


arr1 = np.array([[2.1,2.5],
                [4.2,2.7],
                [2.3,1.9]])

arr2 = np.array([[5,2,3],[1,3,5]])

print(arr1)
print(arr2)
arr3 = np.dot(arr1,arr2)
arr3 = np.trunc(arr3)
print(arr3)

arr = np.arange(1,13,1).reshape(4,-1)
print(arr)
#indexing =>2,5배수 (2,4)행렬

arr1 = arr[arr%2==0]
arr2 = arr[arr%5==0]
print(arr1)
print(arr2)
arr3 = np.append(arr1,arr2)
print(np.sort(arr3).reshape(2,4))



arr = np.random.randint(100,150,(3,10))
arr1 = arr.T
print(arr1)

import matplotlib.pyplot as plt
arr =  10 + np.random.rand(1000) *10

plt.hist(arr,bins=100)
plt.show()

"""