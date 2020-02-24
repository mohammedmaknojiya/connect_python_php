#!/usr/bin/env python
#getvalue=' '.join(sys.argv[1:])
#print(getvalue)
#getvalue="115301"

#print(l)
import sys
getvalue=' '.join(sys.argv[1:])
l=list(getvalue)
#print(l)

import pickle
from sklearn.ensemble.forest import RandomForestClassifier
from sklearn import preprocessing
import pandas as pd
import datetime

l1=[]


#def main():
#getvalue="115301"

a=int(l[0])
l1.append(a)
b=int(l[1])
l1.append(b)
c=int(l[2])
l1.append(c)
d=int(l[3])
l1.append(d)
e=int(l[4])
l1.append(e)
f=int(l[5])
l1.append(f)
#print(l1)
    
####if __name__ == '__main__':
####    main()
###l=[1,1,5,3,0,1]

pd.options.mode.chained_assignment = None

#read data set
X=pd.read_csv("final1.csv",low_memory=False)
#print(X.dtypes)

# convert string to datetime data type
X["in_time"] = pd.to_datetime(X.in_time)
X["out_time"] = pd.to_datetime(X.out_time)
#print(X.dtypes)
#print(X.head)
X['dayofweek'] =X.in_time.dt.weekday
'''
#creating new column to check weekend / weekday
X["is_weekday"]=0

for i in range(0,len(X)):
    if ((X["dayofweek"][i]==5)|(X["dayofweek"][i]==6)):
        X["is_weekday"][i]=0
    else:
        X["is_weekday"][i]=1
'''
#creating new column to check morning/evening slot
X=X.assign(session=pd.cut(X.in_time.dt.hour,[0,13,24],labels=['Morning','Evening']))

#creating age category
bins=[0,15,55,95]
group=['child','adult','old']
X['age_category']=pd.cut(X["age"],bins, labels=group)

#calculating treatment time in seconds(integer) because ml doesnot work on datetime variables 
X['waiting_time'] =X['out_time'].sub(X['in_time'], axis=0)
X['waiting_time']= X['waiting_time'].dt.seconds
##t=X['waiting_time']
##day = t//86400 
##hour = (t-(day*86400))//3600 
##min = (t - ((day*86400) + (hour*3600)))//60  
##X['waiting_time'] = min
#delete none essential columns
X.drop('out_time' ,axis=1, inplace=True)
X.drop('in_time' ,axis=1, inplace=True)
X.drop('dayofweek' ,axis=1, inplace=True)
X.drop('age' ,axis=1, inplace=True)

#print(X.dtypes)

#convert string categories to integer for processing
category_col =['gender','dept','task','age_category','doctortype','session']  
labelEncoder = preprocessing.LabelEncoder() 
  
mapping_dict ={} 
for col in category_col: 
    X[col] = labelEncoder.fit_transform(X[col]) 
  
    le_name_mapping = dict(zip(labelEncoder.classes_, 
                        labelEncoder.transform(labelEncoder.classes_))) 
  
    mapping_dict[col]= le_name_mapping
    
#variable on which prediction is done
y = X.iloc[:,7]
#new data frame consisting on essential factors for prediction
X1=X.drop(['token','waiting_time'],axis=1)

X1.head(10)
    
#(for RANDOM FOREST CLASSIFIER)
forest = RandomForestClassifier(10,random_state=42)
forest.fit(X1,y)
#print(forest.score(X1,y)*100)
# Saving model to disk
pickle.dump(forest, open('model2.pkl','wb'))

# Loading model to compare the results
model2 = pickle.load(open('model2.pkl','rb'))
t=forest.predict([l1])

out=int(t)
#formatting output in particular format
day = out//86400 
hour = (out-(day*86400))//3600 
min = (out - ((day*86400) + (hour*3600)))//60  
seconds = out - ((day*86400) + (hour*3600) + (min*60))
abc = datetime.time(hour, min , seconds)

print(abc)
#print(out)
#t = model.predict([[2,0,0,1,0,1,1]])
#print(t)
