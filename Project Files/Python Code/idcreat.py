#Strike A Spark Web Application

#Group Members with emails:
#Michael Gorse- gor9632@calu.edu
#Anthony Carrola- car3766@calu.edu
#Paul MacLean- mac7537@calu.edu
#Brittany Marietta- mar0274@calu.edu
#Ryan Merow- mer3942@calu.edu
#Zachary Smith- smi2479@calu.edu

#Generates judge IDs

import random
import string

def randomNum():                                
    return random.randint(1, 9)

def randomLetter():
    letters = 'abcdefghijklmnopqrstuvwxyz'
    return random.choice(letters)

def letterVet():                                #makes sure l can't be after 1
    invalid = True                          # can only check the even case initially
    while invalid == True:
        letter = randomLetter()
        number = randomNum()
        if letter == 'l' and number == 1:
            invalid = True
        else:
            invalid = False
    return letter, number
        

def main():
    
    
    keys = [[0]*8 for k in range(50)]               #creates list
    for i in range (0, 50):
        for j in range (0, 8, 2):
            invalid = True
            while invalid == True:                       #checks the odd case
                keys[i][j], keys[i][j+1] = letterVet()
                temp = j
                if j>1 and keys[i][j-1] == 1 and keys[i][j] == 'l':
                    invalid = True
                else:
                    invalid = False

    for i in range (0, 50):                         #prints list
        for j in range (0, 8):
            print(keys[i][j], end='')
        print("\n")

main()
