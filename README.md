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

**GET** `http://localhost/x-corp-app/php/app/FetchActinoRequests.php`

```json
[
  {
    "id": "ex0518987626",
    "priority": "high",
    "date_sent": "2020-06-15 12:56:00",
    "examination": "Angiography",
    "suggested_date": "2020-06-30",
    "description": "",
    "patient_ssn": "576-92-0309",
    "doctor": "darryl.miller@example.com",
    "approval": 1,
    "completed": 0,
    "patient_info": "Rick  Simmons (576-92-0309)"
  },
  {
    "id": "ex7545321819",
    "priority": "high",
    "date_sent": "2020-06-15 12:42:00",
    "examination": "Interventional neurology",
    "suggested_date": "2020-06-26",
    "description": "",
    "patient_ssn": "574-52-2117",
    "doctor": "darryl.miller@example.com",
    "approval": 1,
    "completed": 0,
    "patient_info": "Violet Price (574-52-2117)"
  },
  {...}
]
```

### Fetch All Appointments

**GET** `http://localhost/x-corp-app/php/app/FetchAppointments.php`

```json
  [
    {  
      "0": "completion",
      "id": "ap5564287366",
      "start_date": "2020-06-29 19:00:00",
      "end_date": "2020-06-29 19:00:00",
      "text": "Patient SSN: 574-52-2117, Radiologist: denise.rogers@example.com, Priority: high, Completion: waiting",
      "type": "waiting"
    },
    {
      "0": "completion",
      "id": "ap6247731792",
      "start_date": "2020-06-05 18:20:00",
      "end_date": "2020-06-05 18:20:00",
      "text": "Patient SSN: 529-13-6401, Radiologist: butler@gmail.com, Priority: low, Completion: completed",
      "type": "completed"
    },
    {...}
  ]
```

### Fetch an Array of All Patients Stored in The Database

**GET** `http://localhost/x-corp-app/php/app/FetchPatients.php`

```json
  [
    "Jerome Davis (040-36-7066)",
    "Javier Burke (529-13-6401)",
    "Violet Price (574-52-2117)",
    "Rick  Simmons (576-92-0309)"
  ]
```

## Contributors

[@georgegiam](https://github.com/georgegiam)
