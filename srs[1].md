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
    ||-- 📁 dashboard/                (For SRS 2.1)
    |   |   |-- 📄 index.blade.php       (Will show stats, graphs, shortcuts)
    |-- 📁 modules/
    
    |   |-- 📁 students/                 (For SRS 2.2)
    |   |   |-- 📄 index.blade.php       (The main list/table of students)
    |   |   |-- 📄 create.blade.php      (The "Add Student" form)
    |   |   |-- 📄 edit.blade.php        (The "Edit Student" form)
    |   |   |-- show.blade
    |   |-- 📁 teachers/                 (For SRS 2.5)
    |   |   |-- 📄 index.blade.php       (The main list/table of teachers)
    |   |   |-- 📄 create.blade.php      (The "Add Teacher" form)
    |   |   |-- 📄 edit.blade.php        (The "Edit Teacher" form)
    |   |   |-- show.blade
    |   
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
        |--     mobile-nav
        |--    mobile-sidebar
        |--    mobile-botto-nav
```





# SPA Debug Checklist & Common Issues

## 🔍 Identified Issues

### 1. **Alpine.js Initialization Conflict**
**Problem:** The sidebar Alpine component is defined in the layout file but also needs to be in the sidebar partial.

**Location:** `app.blade.php` line 286-367 vs `sidebar.blade.php`

**Fix:** Move the Alpine.js script to a separate file or ensure it loads before the sidebar renders.

### 2. **Sidebar Toggle Function Duplication**
**Problem:** Two different sidebar toggle implementations:
- Global `toggleSidebar()` function (line 41-76)
- Alpine.js `toggleSidebar()` method (line 363-368)

**Fix:** Use only ONE implementation. Recommend using Alpine.js exclusively.

### 3. **Sidebar State Sync Issue**
**Problem:** The collapsed state is managed in two places:
- `window.appState.sidebarCollapsed`
- Alpine's `sidebarCollapsed`

**Fix:** Remove global state, use Alpine as single source of truth.

### 4. **Navigation Active State Not Updating**
**Problem:** `isActive()` and `isExactActive()` check `this.currentPath` but it's not always updated on SPA navigation.

**Fix:** The `spa:navigated` event listener is there but may fire after render.

### 5. **Dropdown State Lost on Page Refresh**
**Problem:** Dropdowns close when navigating because `updateDropdownsFromURL()` calls `closeAllDropdowns()` first.

**Fix:** This is actually intentional, but if you want dropdowns to stay open, modify the logic.

### 6. **Router Click Handler May Fire Twice**
**Problem:** Router uses capture phase (`true`) and Alpine also handles clicks.

**Fix:** Ensure `e.stopPropagation()` is working correctly.

### 7. **Missing Error Handling in Alpine Init**
**Problem:** If localStorage fails, some browsers throw errors that aren't caught.

**Fix:** Already wrapped in try-catch, but could be more robust.

---

## 🛠️ Quick Fixes

### Fix 1: Unified Sidebar Toggle (Recommended)

**Remove** the global `toggleSidebar()` function from `app.blade.php` (lines 41-76) and update the button to use Alpine:

```html
<!-- In navbar -->
<button @click="$dispatch('toggle-sidebar')" id="sidebarToggle">
    <i class="fas fa-chevron-left"></i>
</button>
```

**Update Alpine component** to listen for the event:

```javascript
init() {
    // ... existing code ...
    
    // Listen for toggle event from navbar
    window.addEventListener('toggle-sidebar', () => {
        this.toggleSidebar();
    });
}
```

### Fix 2: Ensure Navigation Updates Work

**Add logging to debug navigation updates:**

```javascript
updateDropdownsFromURL(path) {
    console.log('🔄 Updating dropdowns for path:', path);
    this.closeAllDropdowns();

    if (!this.sidebarCollapsed) {
        if (path.startsWith('/admin/students')) {
            console.log('✅ Opening students dropdown');
            this.dropdowns.students = true;
        }
        else if (path.startsWith('/admin/teachers')) {
            console.log('✅ Opening teachers dropdown');
            this.dropdowns.teachers = true;
        }
        // ... rest of conditions
    }
}
```

### Fix 3: Fix Sidebar State Persistence

**In the Alpine component, ensure proper initialization:**

```javascript
init() {
    // Initialize from window.appState if it exists
    if (window.appState && window.appState.sidebarCollapsed !== undefined) {
        this.sidebarCollapsed = window.appState.sidebarCollapsed;
    } else {
        try {
            this.sidebarCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
        } catch (e) {
            this.sidebarCollapsed = false;
        }
    }
    
    // Sync to global state
    if (window.appState) {
        window.appState.sidebarCollapsed = this.sidebarCollapsed;
    }
    
    // ... rest of init
}
```

---

## 🐛 Debugging Steps

### Step 1: Check Console Logs
Open browser console and check for:
- ✅ SPA initialized
- ✅ App initialized
- 🔗 SPA Router intercepted: [URL]
- 📍 Navigated to: [path]
- 🎨 Content rendered

### Step 2: Test Sidebar Toggle
```javascript
// In console, check state:
console.log('Collapsed:', window.appState.sidebarCollapsed);
console.log('Alpine state:', Alpine.$data(document.querySelector('[x-data="sidebarData"]')));

// Try toggling:
toggleSidebar(); // Should toggle via global function
```

### Step 3: Test Navigation
```javascript
// In console:
window.router.navigate('/admin/students');
// Check if dropdown opens

// Check Alpine state:
Alpine.$data(document.querySelector('[x-data="sidebarData"]')).dropdowns
```

### Step 4: Check Event Listeners
```javascript
// See what's listening to navigation:
window.getEventListeners(window)['spa:navigated'];
```

### Step 5: Verify Router Interception
Click a link and check console. Should see:
```
🔗 SPA Router intercepted: /admin/students
📦 Loading from cache: /admin/students (or fetching)
📍 Navigated to: /admin/students
🎨 Content rendered
```

---

## 🚨 Critical Issues to Check

### Issue 1: Is Alpine.js Loading?
```javascript
// In console:
typeof Alpine !== 'undefined' // Should be true
```

If `false`, check CDN link or network tab.

### Issue 2: Is Router Initialized?
```javascript
// In console:
typeof window.router !== 'undefined' // Should be true
window.router instanceof SPARouter // Should be true
```

### Issue 3: Are Links Being Intercepted?
Add breakpoint in `spa-router.js` line 20 or add:
```javascript
document.addEventListener('click', (e) => {
    const link = e.target.closest('a[href]');
    if (link) console.log('🔗 Link clicked:', link.href);
}, true);
```

### Issue 4: Is Content Rendering?
```javascript
// Check if content exists:
document.querySelector('#page-content') !== null // Should be true
document.querySelector('#page-content-mobile') !== null // Should be true
```

---

## 📋 Testing Checklist

- [ ] Sidebar toggles correctly (icon changes, width animates)
- [ ] Sidebar state persists on refresh
- [ ] Navigation works without page reload
- [ ] Active menu item highlights correctly
- [ ] Dropdowns open for relevant sections
- [ ] Dropdowns close when clicking elsewhere
- [ ] Back/forward buttons work
- [ ] Mobile navigation works
- [ ] Flash messages appear
- [ ] Loading indicator shows during navigation
- [ ] Forms submit via AJAX
- [ ] Validation errors display correctly

---

## 🔧 Recommended Refactors

### 1. Simplify State Management
Choose ONE approach:
- **Option A:** Pure Alpine.js (recommended for Laravel)
- **Option B:** Pure vanilla JS with global state

### 2. Separate Concerns
Move Alpine component definition to:
```
/resources/js/components/sidebar.js
```

### 3. Add Debug Mode
```javascript
window.DEBUG = true; // Set via environment

if (window.DEBUG) {
    console.log('🔍 Debug mode enabled');
}
```

---

## 📞 What to Check First

1. **Open DevTools Console** - Look for errors
2. **Network Tab** - Check if routes return HTML
3. **Vue/Alpine DevTools** - Inspect component state
4. **LocalStorage** - Check `sidebarCollapsed` value
5. **Click a link** - Does URL change? Does content update?

---

## 💡 Quick Test Commands

```javascript
// Test navigation
window.router.navigate('/admin/students');

// Test sidebar
toggleSidebar();

// Check Alpine state
Alpine.$data(document.querySelector('[x-data="sidebarData"]'));

// Clear cache
window.router.clearCache();

// Refresh current page
window.router.refresh();
```

---

## Need More Help?

**Tell me:**
1. What specific issue are you seeing? (sidebar not toggling, navigation not working, etc.)
2. Any console errors?
3. What happens when you click a link?
4. Is the URL changing but content not updating?
5. Are dropdowns not opening/closing?

I'll provide targeted fixes based on your specific issue!
