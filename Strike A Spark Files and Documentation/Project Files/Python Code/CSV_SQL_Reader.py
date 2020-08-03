Strike A Spark Web Application

#Group Members with emails:
#Michael Gorse- gor9632@calu.edu
#Anthony Carrola- car3766@calu.edu
#Paul MacLean- mac7537@calu.edu
#Brittany Marietta- mar0274@calu.edu
#Ryan Merow- mer3942@calu.edu
#Zachary Smith- smi2479@calu.edu

#uploads data to the database

import csv ##allows work with csv files
import cx_Oracle as Database##allows interactions with SQL database

try:
    connectionString = "smi2479/smi2479@orion.calu.edu:1521/ORCL" #connection variable
    con = Database.connect(connectionString, encoding = "UTF-8", nencoding = "UTF-8")#connection to database stored as object
                           #^connection to database, webiste help: https://www.oracle.com/technetwork/articles/dsl/prez-python-queries-101587.html
                           #^^Unicode used because characters & symbols used in CSV will cause issues with the parsing
                            ##^Website Link w/ Explanation: https://github.com/oracle/python-cx_Oracle/issues/36
except Exception as error1:
    print("Error1:",error1) #exception/error handling

try:
    cursor = con.cursor()#cursor object connects to database
             #^Connects the cursor to the database so that SQL statements can be executed
except Exception as error2:
    print(error2) #exception/error handling   

try: #Checks for both CSV file and proper cx_Oracle Parameters
    fileString = '2019_Poster_Judging_Final_Unsorted.csv'
    with open (fileString,mode = 'r',newline = '') as csv_file: #opens csv file
               #^Put CSV file with .py file to parse data
        
        #Dictionary Reader object made from file
        posterlist = csv.DictReader(csv_file, delimiter=',', quotechar='"')
        
##        #Print the dictionary list if desired
##        for row in posterlist:
##            print(row['ID'],row['Title'],row['Submission Type'])

        #insert by query
        for row in posterlist:
            query1 = "INSERT INTO POSTER (PRESENT_TIME,POSTER_ID,TITLE,SUBMISSION_TYPE) VALUES ("+"'"+row['AM/PM']+"'"+","+"'"+row['Poster #']+"'"+","+"'"+row['Title']+"'"+","+"'"+row['Submission Type']+"'"+")"
                #^Query statement concatenation
            query2 = "INSERT INTO PRESENTER (DEGREE_LEVEL,NAME,CATEGORY,AREA_OF_STUDY) VALUES ("+"'"+row['Graduate/Undergraduate']+"'"+","+"'"+row['Name(s)']+"'"+","+"'"+row['Submission category']+"'"+","+"'"+row['Area of study']+"'"+")"
                #^Query statement concatenation            
            cursor.execute(query1)#Cursor executes the first query
            cursor.execute(query2)#Cursor executes the second query
            
            
        
except Exception as error3:
    print("Error3:",error3)#exception/error handling

#Closing oracle objects
con.commit()#essentially updates database
cursor.close()#closes cursor
con.close()#closes connection to database

print("Transfer Completed")#Parsing Confirmation Message

#Notes about program:
#-Previous Strike-a-Spark Team-
##~The row[] IDs will be relative to the CSV you're using, adjust their names
##~Double check you're reading in the correct CSV file before executing anything
##~The CSV items can't have an apostrophe, it will mess with the SQL statement that you're trying to execute
##~^You could remove them from the "Excel" sheet entirely, or add a second where you find one

