# Importing BeautifulSoup and it
# is in the bs4 module
from bs4 import BeautifulSoup


def getCourses():
  
# Opening the html file. If the file
# is present in different location, 
# exact location need to be mentioned
    HTMLFileToBeOpened = open("cs-complete2.html", "r")
    
    # # Reading the file and storing in a variable
    contents = HTMLFileToBeOpened.read()
    
    # Creating a BeautifulSoup object and 
    # specifying the parser
    
    soup = BeautifulSoup(contents, "html.parser")

    mainPage = soup.find(id="bukku-page")
    courses = mainPage.find_all('p')

    courseTable = []

    for course in courses:

        course_id = course.find(class_="course_address").a.text
        course_address = course.find(class_="course_address").a.get("href")

        course_title = course.find(class_="course_title").text
        course_hours = course.find(class_="course_hours").text.strip("()")
        course_description = course.find(class_="course_hours").next_sibling
        course_prerequisite_link = ""
        course_prerequisite = ""

        if (len(course.find_all("a")) > 1):
            course_prerequisite_link = course.find_all("a")[1].get("href")
            course_prerequisite = course.find_all("a")[1].text
        
        courseTable.append((course_id, course_address, course_title, course_hours, 
        str(course_description), course_prerequisite_link, course_prerequisite))
    return courseTable


def saveToFile():
    courseTable = getCourses()
    createTableQuery = """CREATE TABLE `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `CourseId` int(11) DEFAULT NULL,
  `CourseAddress` varchar(255) DEFAULT NULL,
  `CourseTitle`    varchar(255) DEFAULT NULL,
  `CourseHours`   varchar(50)  DEFAULT NULL,
  `CourseDescription` text,
  `CoursePrereqAddress` varchar(255) DEFAULT NULL,
  `CoursePrereqTitle` varchar(255) DEFAULT NULL, 
  `created_at`    datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at`    datetime ON UPDATE CURRENT_TIMESTAMP
 );"""

    insertTableQuery = """INSERT INTO `courses` VALUES """
    with open('courseInfo.sql', 'w') as f:
        f.write(createTableQuery + '\n\n\n')
        f.write(insertTableQuery)
        for course in courseTable:
            l = []
            for x in course:
                l.append("'" + x + "'")
            line = ",".join(l)
            f.write("(" + line + ")" + "," +'\n')
    
    



saveToFile()        
