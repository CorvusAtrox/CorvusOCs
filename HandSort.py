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
            val = raw_input("l: " + left[i]['Name'] + " or r: " + right[j]['Name'] + "? ")
            if(val == "b"):
                quit()
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

with open('ocdata.json') as data_file: 
    js = json.load(data_file)

mergeSot(js, js)

with open('ocdata.json', 'w') as outfile:
    json.dump(js, outfile)