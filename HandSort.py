import json

def mergeSot(array, js):
    if len(array) > 1:
        mid = len(array)//2
        left = array[:mid]
        right = array[mid:]
        
        mergeSot(left, js)
        mergeSot(right, js)
        
        i = 0
        j = 0
        k = 0
        while i < len(left) and j < len(right):
            val = raw_input("l: " + left[i]['Name'].encode('utf8') +
                            " or r: " + right[j]['Name'].encode('utf8') + "? ")
            if(val == "b"):
                break
            if(val == "l"):
                array[k] = left[i]
                i += 1
                k += 1
            if(val == "r"):
                array[k] = right[j]
                j += 1
                k += 1
        while i < len(left):
            array[k] = left[i]
            i += 1
            k += 1
        while j < len(right):
            array[k] = right[j]
            j += 1
            k += 1
            
def bubbleSot(alist):
    for passnum in range(len(alist)-1,0,-1):
        for i in range(passnum):
            val = raw_input("l: " + alist[i]['Name'] + " or r: " + alist[i+1]['Name'] + "? ")
            if(val == "b"):
                break
            if(val == "r"):
                temp = alist[i]
                alist[i] = alist[i+1]
                alist[i+1] = temp
                
def insertionSot(alist):
   b = True
   for index in range(1,len(alist)):

     currentvalue = alist[index]
     position = index
     if(b == False):
        break
     
     v= True
     while position>0 and v:
         val = raw_input("l: " + alist[position-1]['Name'].encode('utf8') + 
                        " or r: " + currentvalue['Name'].encode('utf8') + "? ")
         if(val == "b"):
            b = False
            break
         if(val == "r"):
            alist[position]=alist[position-1]
            position = position-1
         if(val == "l"):
            v = False
         

     alist[position]=currentvalue

with open('ocdata.json') as data_file: 
    js = json.load(data_file)

mergeSot(js,js)
#insertionSot(js)

with open('ocdata.json', 'w') as outfile:
    json.dump(js, outfile)