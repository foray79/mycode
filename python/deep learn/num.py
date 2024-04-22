import numpy as np
import matplotlib.pyplot as plt
"""
a=[1.,2.,3.]
print(a)
b = np.array(a)
print(b)

c= b.astype(np.float32)
print(c)

d = c.ndim
print(d)

print(c.shape)
print(c.dtype)


#Array
print(np.ones((3,4),dtype=int))

print (np.zeros((5,5)))
print (np.zeros((5,5))+6)
print (np.eye(4))
x=np.diag((1,2,3,4))
print (x)

#eg_array  = np.array([[1,2,3],[4,5,6]])

x= np.array([[0.58, 0.05, 0.84, 0.21],
             [0.88, 0.98, 0.45, 0.13],
             [0.10, 0.52, 0.58, 0.38],
             [0.84, 0.76, 0.25, 0.07]])

#replace x with (0,1,2,3) and >0.8 +1

x[0.8<x] +=1
x[np.arange(4) , np.arange(4)] = range(4)
print(x)

matrix = np.array([[1,2,3],[4,5,6]])
row_vector = np.array([1,2,3])

#print(row_vector)
column_vector = np.array([1,2,3]).reshape(-1,1)

value = row_vector @ column_vector
print(matrix)
print(matrix.T)



x= np.linspace(0,10,100)
plt.plot(x,np.sin(x))
plt.xlabel('x-axis')
plt.xlim([2,8])
plt.show()

rng = np.random.RandomState(123)
x=rng.normal(size=500)
y=rng.normal(size=500)

plt.scatter(x,y)
plt.show()


means = [5,8,10]
stddevs=[0.2, 0.4, 0.5]
bar_labels = ['bar 1','bar 2', 'bar 3']
x_pos = list(range(len(bar_labels)))
plt.bar(x_pos,means,yerr=stddevs)
plt.show()

rng = np.random.RandomState(123)

x = rng.normal(0,20,1000)
y = rng.normal(15,10,1000)

bins = np.arange(-100,100,5)
plt.hist(x,bins=bins,alpha=0.5)
plt.hist(y,bins=bins,alpha=0.5)
plt.show()

"""
"""
#1차원
arr = np.array([1,2,3])
#print(arr)

#2차원
arr = np.array([[1,2,3],[4,5,6]])
#print(arr)

#shape
arr1 = np.array([1,2,3])
arr2 = np.array([[1,2,3],[4,5,6]])

arr1.shape #(3,)
arr2.shape #(2,3)

arr1.ndim # 1
arr2.ndim # 2
#size
arr1.size #3
arr2.size #6


arr = np.array([1,2,3],dtype=np.float64)
print(arr, arr.dtype) #[1. 2. 3.] float64
arr1 = np.array([False,True,True],dtype=np.bool_)
print(arr1, arr1.dtype) #[1. 2. 3.] float64

arr1 = arr.astype(np.float32)
print(arr1, arr1.dtype) #[1. 2. 3.] float32


"""
"""
arr1 = np.zeros([2,2])
print(arr1) #[[0. 0.][0. 0.]]

arr2 = np.ones([3,5])
print(arr2) #[[1. 1. 1. 1. 1.][1. 1. 1. 1. 1.][1. 1. 1. 1. 1.]]

arr3 = np.full((2,3),5)

print(arr3) #[[5 5 5][5 5 5]]

arr4 = np.eye(3)
print(arr4)

arr5 = np.array([[1,2,3],[4,5,6]])

arr5_1 = np.zeros_like(arr5)
print(arr5_1)


arr = np.arange(9)
print(arr) #[0 1 2 3 4 5 6 7 8]
arr1 = np.arange(3,12)
print(arr1) #[ 3  4  5  6  7  8  9 10 11]
arr2 = np.arange(start=3,stop=13,step=3)#stop 미만

print(arr2) #[3  6  9 12]

arr = np.linspace(0,100,50) # 0~100에서 균등하게 11개를 가져옴
print(arr)



arr = np.random.normal(0,1,(2,3)) #정규분포(평균,표준편차,개수)
print(arr)
arr2 = np.random.normal(0,1,1000)
#plt.hist(arr2, bins=100)
#plt.show()

arr3 = np.random.rand(1000) #균등
#plt.hist(arr3, bins=100)
#plt.show()

arr4 = np.random.randn(1000) #정규분포
#plt.hist(arr4, bins=100)
#plt.show()

arr5 = np.random.randint(low=1,high=5, size=(3,4))
print(arr5)
arr6 = np.random.randint(5) #0~5중 한개의 정수


#indexing

arr = np.arange(10)
print(arr[3]) #3
print(arr[3:8]) #3 4 5 6 7
print(arr[3:]) #3 4 5 6 7 8 9
print(arr[:7]) #0 1 2 3 4 5 6

arr1 = np.array([[1,2,3,4],[5,6,7,8],[9,10,11,12]])

print(arr1[0,3]) #4
print(arr1[0,:]) #1 2 3 4
print(arr1[:,1]) #2 6 10

print(arr1[:2,2:]) #[3,4] [7,8]

#fancy indexing
arr = np.arange(5,30,5)
print(arr[[0,2,4]]) # 5 15 25


arr1 = np.array([[5,10,15,20],
                 [25,30,35,40],
                 [45,50,55,60]])
print(arr1[[0,2],2:]) #[15 20][55 60]
print(arr1[1:,[2,3]]) #[35 40][55 60]

#boolean indexing
arr = np.arange(1,5,1)

print(arr[[True,False,True,True]]) # 1 3 4

arr1 = np.array([[1,2,3,4],[5,6,7,8]])
print(arr1[[True,False],True]) # [1 2 3 4]

print(arr1[arr1>3]) # [ 4 5 6 7 8]

#연산

arr1 = np.array([[1,2,3],[4,5,6],[7,8,9]])

arr2 = np.full((3,3),2)
print(arr1)
print(arr2)
#덧셈
print(np.add(arr1 , arr2))
print(arr1 + arr2)
#뺄셈
print(arr1-arr2)
print( np.subtract(arr1,arr2))
#곱셈
print(arr1*arr2)
print( np.multiply(arr1,arr2)) # 단순한 원소간 곱셈
#나누셈
print(arr1/arr2)
print( np.divide(arr1,arr2)) # 단순한 원소간 나누셈

#제곱
print(arr1**2)
print(np.square(arr1))

#제곱근
print(np.sqrt(arr1))

#몫
print(arr1//2)

#나머지
print(arr1%2)


#행렬곱
arr1 = np.array([2,3,4])
arr2 = np.array([1,2,3])
print(np.dot(arr1,arr2)) #20

arr1 = np.array([[1,2],[4,5]])
arr2 = np.array([[1,2],[0,3]])
print(np.dot(arr1,arr2)) # [1 8 ][4 23]

#절대값
arr1 = np.array([[1,-2],[-4,5]])
print(np.abs(arr1))

#올림
arr1 = np.array([[1.932,-2.339],[-4.15,5.206]])
print(np.ceil(arr1))

#내림
arr =np.random.normal(0,3.5,(2,2)) #정규분포(평균,표준편차,개수)
print(np.floor(arr))

#반올림
arr =np.random.normal(0,3.5,(2,2)) #정규분포(평균,표준편차,개수)
print(np.round(arr))

#버림
arr =np.random.normal(0,3.5,(2,2)) #정규분포(평균,표준편차,개수)
print(np.trunc(arr))

#min , max
arr = np.random.randint(low=0,high=5, size=(2,3))
print(arr)
print(arr.min())
print(arr.min(axis=1))

#원소의 합 sum
arr = np.random.randint(low=0,high=9, size=(3,3))
print("원소", arr)
print("합" , arr.sum())

#평균 mean
print("평균", arr.mean())
#표준 편자 : std
print("표준 편자", arr.std())
#누적합:cumsum
print("누적합", arr.cumsum(axis=1))
#중앙값 median
print("중앙값", np.median(arr))


arr1 = np.random.randint(low=3,high=5, size=(2,3))
arr2 = np.random.randint(low=3,high=5, size=(2,3))
print("원소1", arr1)
print("원소2", arr2)
print(arr1==arr2)
print(np.array_equal(arr1,arr2))


ar= np.random.randint(15,size=(3,4))
print(ar)
#print(np.sort(ar))
print(np.sort(ar,axis=1))
print(np.argsort(ar,axis=1))

#arr = np.arange(12)
#print(arr,arr.ndim)
#print(arr.reshape(-1,3,2))

arr1 = np.array([1,2,3])
arr1 = np.expand_dims(arr1,axis=1)
arr1 = np.expand_dims(arr1,axis=0)

arr = np.zeros((3,3,2))
print(arr,arr.shape,arr.ndim)
arr2 = np.squeeze(arr)
print(arr2,arr2.shape,arr2.ndim)

#print(arr)
num = np.arange(6)
arr = num.reshape(3,2)
#arr = np.array([[1,2],[3,4]])
print(arr)
print(arr.T)


arr = np.array([[1,2],
 [3,4],
 [5,6]])

arr1 = np.array([[2,2],
[2,2],
[2,2]])

print(arr.dot(arr1.T))



arr = np.arange(1,13).reshape(3,-1)
print(arr)
arr1= np.insert(arr,2,50)
print(arr1)

arr = np.arange(1,13).reshape(3,-1)
print(arr)
arr1= np.delete(arr,2,axis=1)
print(arr1)

# 병합 append vstack, hstack, concatenate
print("===========")
arr1 = np.arange(1,7).reshape(2,-1)
arr2 = np.arange(7,13).reshape(2,-1)
arr3 = np.append(arr1,arr2)
arr4 = np.vstack((arr1,arr2))
arr5 = np.hstack((arr1,arr2))
ar6 = np.concatenate([arr1,arr2],axis=0)
print(arr1)
print(arr2)
print(ar6)
"""
# 분할 vsplit, hsplit ,
arr1 = np.arange(1,13).reshape(3,-1)
arr2 = np.vsplit(arr1,3)
print(arr1)
print(arr2)
