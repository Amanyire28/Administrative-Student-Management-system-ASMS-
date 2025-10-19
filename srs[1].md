# Software Requirements Specification (SRS)
## Administrative Student Management System (ASMS)



## 1. Introduction

### 1.1 Purpose
The purpose of this document is to specify the functional and non-functional requirements of the **Administrative Student Management System (ASMS)**.  
The system is designed to simplify and automate administrative operations within educational institutions, focusing on student recorgit d management, class organization, marks entry, and academic report generation.  
This SRS serves as a guide for both the design and implementation phases.

---

### 1.2 Scope
The Administrative Student Management System (ASMS) is a **web-based platform** accessible only to **school administrators** and authorized staff.  

The system’s core functions include:
- Managing student data (registration, updates, and record maintenance)
- Handling class and subject structures
- Automating marks computation and report card generation
- Managing teacher assignments
- Generating analytics and performance reports

The project will initially focus on the **front-end design** using **Bootstrap** and minimal **custom CSS**, followed by **back-end integration** with PHP and MySQL in a later phase.

---

### 1.3 Objectives
- To create an efficient digital system for managing student information.  
- To automate the report card generation process.  
- To provide visual analytics for performance and administrative data.  
- To reduce manual errors and paperwork.  
- To improve decision-making through real-time reports and summaries.

---

### 1.4 Intended Users
- **School Administrators** – manage all modules and monitor school data.  
- **Academic Staff** – record student marks, manage classes, and view reports.  
- **Records Officer** – handle student registration and record maintenance.  

> **Note:** Students and parents do not have access to the system.

---

### 1.5 System Overview
The ASMS will consist of the following core modules:
1. Dashboard  
2. Student Management  
3. Class and Subject Management  
4. Marks and Report Card Automation  
5. Teacher Management  
6. Reports and Analytics  

---

## 2. Functional Requirements

### 2.1 Dashboard
- View total number of students, teachers, and classes.  
- Display performance trends using graphs.  
- Show recent activities and notifications.  
- Provide shortcuts to main actions (e.g., Add Student, Enter Marks).

---

### 2.2 Student Management
- Add, edit, delete, or view student details.  
- Search and filter students by name, ID, or class.  
- Upload and display student photos.  
- Export student lists to PDF or Excel.

---

### 2.3 Class and Subject Management
- Create and manage classes.  
- Add and manage subjects.  
- Assign students and teachers to specific classes and subjects.  
- Handle student promotions between classes.

---

### 2.4 Marks and Report Card Automation
- Enter and store marks per subject and term.  
- Automatically calculate totals, averages, and grades.  
- Generate and print student report cards.  
- Generate performance charts and summaries.

---

### 2.5 Teacher Management
- Add and manage teacher profiles.  
- Assign teachers to specific subjects and classes.  
- Update teacher details or delete records.  
- View teaching loads and mark submissions.

---

### 2.6 Reports and Analytics
- Generate performance and attendance reports.  
- Provide data visualizations (charts and graphs).  
- Export reports in printable or downloadable format.

---

## 3. Non-Functional Requirements

### 3.1 Usability
- Clean, responsive, and intuitive interface built with Bootstrap.  
- Mobile-friendly layout for accessibility on different devices.  

### 3.2 Performance
- Fast page load times with optimized assets.  
- Efficient data retrieval when backend is integrated.  

### 3.3 Reliability
- System should store and retrieve accurate records without data loss.  

### 3.4 Security
- Authentication required for access.  
- Role-based control restricted to administrators only.  

### 3.5 Maintainability
- Clear code structure with separation of front-end and back-end.  
- Modular files to simplify updates.  

### 3.6 Scalability
- Architecture supports addition of new modules (e.g., Attendance, Finance).  

---

## 4. Development Environment

| Component | Description |
|------------|--------------|
| **Front-End** | HTML5, Bootstrap 5.3.2, Vanilla JavaScript (no jQuery), minimal custom CSS |
| **Back-End (to be added)** | PHP, MySQL |
| **Web Server** | WAMP/XAMPP or live server |
| **IDE/Editor** | Visual Studio Code |
| **Browser Support** | Chrome, Edge, Firefox |

---

## 5. System Design Approach
The system will be developed using a **modular, prototype-based approach**, beginning with the front-end interface.  
The front-end will include pages and templates for each selected module, ensuring consistent navigation and layout.  
Once the interface is complete, it will be integrated with the backend to handle data and authentication.

---

## 6. Expected Deliverables
- Fully functional front-end interface with Bootstrap layout.  
- Integrated modules for Student, Teacher, and Class management.  
- Automated marks and report card generator.  
- Printable reports and charts.  
- Well-structured, scalable project directory.

---

## 7. Access Control
- **Access:** Administration only.  
- **Authentication:** Admin login required to access the system.  
- **User Roles:** All users have administrative privileges.  
- **Security:** Session-based protection (implemented during backend integration).

---

## 8. Development Phases
| Phase | Focus | Key Output |
|-------|--------|-------------|
| **Phase 1** | Front-End (Bootstrap) | UI/UX, Dashboard, Student Management, Reports |
| **Phase 2** | Back-End Integration | Database, Authentication, CRUD Operations |
| **Phase 3** | Enhancement | Analytics, Printing, Report Automation |

---

## 9. Expected Outcomes
- Streamlined student and academic record management.  
- Automated report card generation.  
- Efficient performance tracking and analytics.  
- Reduction of administrative workload.  
- Real-time access to accurate academic data.

---

**Prepared by:** *Mathew Amanyire*  
**Project:** *Administrative Student Management System (ASMS)*  
**Development Approach:** Front-End First (Bootstrap + minimal CSS)






📁 resources/
└── 📁 views/
    |
    |-- 📁 auth/
    |   |-- 📄 login.blade.php           (SRS 3.4 & 7.0: Admin login page)
    |
    |-- 📁 layouts/
    |   |-- 📄 app.blade.php             (The main admin layout "shell")
    |   |-- 📄 guest.blade.php           (A simpler layout just for the login page)
    |
    |-- 📁 modules/
    |   |
    |   |-- 📁 dashboard/                (For SRS 2.1)
    |   |   |-- 📄 index.blade.php       (Will show stats, graphs, shortcuts)
    |   |
    |   |-- 📁 students/                 (For SRS 2.2)
    |   |   |-- 📄 index.blade.php       (The main list/table of students)
    |   |   |-- 📄 create.blade.php      (The "Add Student" form)
    |   |   |-- 📄 edit.blade.php        (The "Edit Student" form)
    |   |
    |   |-- 📁 teachers/                 (For SRS 2.5)
    |   |   |-- 📄 index.blade.php       (The main list/table of teachers)
    |   |   |-- 📄 create.blade.php      (The "Add Teacher" form)
    |   |   |-- 📄 edit.blade.php        (The "Edit Teacher" form)
    |   |
    |   |-- 📁 academics/                (For SRS 2.3: Class & Subject Management)
    |   |   |-- 📄 classes.blade.php     (Page to create/manage classes)
    |   |   |-- 📄 subjects.blade.php    (Page to create/manage subjects)
    |   |   |-- 📄 assignments.blade.php (Page to assign students/teachers)
    |   |
    |   |-- 📁 marks/                    (For SRS 2.4: Marks Entry)
    |   |   |-- 📄 entry.blade.php       (Form to select class/subject to enter marks)
    |   |
    |   |-- 📁 reports/                  (For SRS 2.4 & 2.6: Reports)
    |       |-- 📄 index.blade.php       (A dashboard to *generate* reports)
    |       |-- 📁 templates/
    |           |-- 📄 report-card.blade.php (The printable report card)
    |
    └── 📁 partials/                     (Your reusable parts, included in layouts/app.blade.php)
        |-- 📄 sidebar.blade.php         (The main left-side navigation)
        |-- 📄 navbar.blade.php          (The top navigation bar)
        |-- 📄 footer.blade.php          (The footer for the admin panel)
```

