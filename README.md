<img align="right" src="img/logo.webp"></div>

<h1 align="left"><a href="https://www.x-corp.systems">X-CORP</a> eHealth App</h1>

Part of [eHealth Services](https://www.ds.unipi.gr/en/courses/e-health-services-2/) Semester Project 2020  
![MIT LICENSE](https://img.shields.io/github/license/KostasXikis/x-corp-app?style=flat-square)

## What Is It

It is a web-based platform that helps with the management of radiological procedures of health districts.
Doctors, Radiologists and Actinology Center admins have the ability to register on the platform and start managing X-ray exams.

## What Problem Does This Solve

Actinology centers can use this platform to assign X-ray exams to the right radiologists at the right time, based on **availability** and **exam priority**. This saves valuable **time** for patients and resources for hospitals.

## What Does It Do

* A **Doctor** makes a radiology request for a patient.  
* The **Actinology Center** admin sees the doctor's radiology request and then needs to set an appointment for the patient.  
The problem is **which radiologist should be assigned the appointment**.  
The app recommends the right radiologist(s) based on:  
  * **Radiologist Availability**.
  * **Number of appointments each radiologist has**.
  * **Exam priority** (that has been set by the doctor).  
* The radiologist is assigned the appointment and completes the X-ray exam.  

## Tech Stack

Front End | Back End | Database | Server
:------------: | :-------------: | :-------------: | :-------------: |
HTML5/CSS3 | PHP | MySQL | Apache
Boostrap 4 |     |       |
jQuery     |     |       |
JavaScript |     |       |
[DHTMLX Scheduler](https://dhtmlx.com/docs/products/dhtmlxScheduler/) | | |

## Some API Endpoints

### Fetch All Actinology Requests

**POST** `http://localhost/health_web_app/php/app/FetchActinoRequests.php`

```json
[
  {
    "id": "ex3532870249",
    "priority": "low",
    "date_sent": "2020-05-16 05:12:00",
    "examination": "MRI",
    "suggested_date": "2020-05-21",
    "description": "kostakis",
    "patient_ssn": "257-60-7795",
    "doctor": "kostaschikis@gmail.com",
    "approval": 1,
    "completed": 0,
    "patient_info": "Travis Gibson (257-60-7795)"
  },
  {
    "id": "ex1296103736",
    "priority": "high",
    "date_sent": "2020-05-18 11:45:00",
    "examination": "CT Scan",
    "suggested_date": "2020-05-21",
    "description": "gghkl",
    "patient_ssn": "84675464",
    "doctor": "kati@gmail.com",
    "approval": 1,
    "completed": 0,
    "patient_info": "Clifton Lopez (84675464)"
  },
  ...
]
```

### Fetch All Appointments

**POST** `http://localhost/health_web_app/php/app/FetchAppointments.php`

```json
  [
    {  
      "0": "completion",
      "id": "ap5041214586",
      "start_date": "2020-05-26 08:00:00",
      "end_date": "2020-05-26 08:00:00",
      "text": "Patient SSN: 257-60-7795, Radiologist: actino3@lab.com, Priority: low, Completion: waiting",
      "type": "waiting"
    },
    {
      "0": "completion",
      "id": "ap5941773206",
      "start_date": "2020-05-23 12:05:00",
      "end_date": "2020-05-23 12:05:00",
      "text": "Patient SSN: 84675464, Radiologist: actino2@lab, Priority: high, Completion: waiting",
      "type": "waiting"
    },
    ...
  ]
```


## Contributors

[@georgegiam](https://github.com/georgegiam)
