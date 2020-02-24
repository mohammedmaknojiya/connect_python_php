#!/usr/bin/env python
import sys
getvalue=' '.join(sys.argv[1:])
print(getvalue)
l1=[]
def main():
    l=list(getvalue)
    
    
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

    
    h=a+b+c+d+e+f
    #print(h)

if __name__ == '__main__':
    main()
