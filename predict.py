import pickle
import numpy as np
import sys
import json
filename = './model/KNN_model.sav'
arr=list(map(float,sys.argv[1:]))
if len(arr)==6:
    arr.insert(4,sum(arr)/6)
arr=np.array(arr)

   
arr=arr.reshape(-1,7)

LR=[] 
loaded_model = pickle.load(open(filename, 'rb'))

result = loaded_model.predict(arr)
LR.append(result[0])
filename = './model/LOG_model.sav'
loaded_model = pickle.load(open(filename, 'rb'))

result = loaded_model.predict(arr)
LR.append(result[0])
filename = './model/RF_model.sav'
loaded_model = pickle.load(open(filename, 'rb'))
result = loaded_model.predict(arr)
LR.append(result[0])
filename = './model/NB_model.sav'
loaded_model = pickle.load(open(filename, 'rb'))
result = loaded_model.predict(arr)
LR.append(result[0])
filename = './model/SVM_model.sav'
loaded_model = pickle.load(open(filename, 'rb'))
result = loaded_model.predict(arr)
LR.append(result[0])
print(json.dumps(LR))
