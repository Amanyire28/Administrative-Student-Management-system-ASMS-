document.addEventListener('DOMContentLoaded', () => {
  // Sidebar active link handler — loads modules dynamically when needed
  const links = document.querySelectorAll('.sidebar .nav-link');
  links.forEach(link => {
    link.addEventListener('click', (e) => {
      e.preventDefault();
      links.forEach(l => l.classList.remove('active'));
      link.classList.add('active');
      const text = link.textContent.trim();
      console.log('[ASMS] nav click ->', text);
      const dbg = document.getElementById('debug-area'); if(dbg) dbg.textContent = `nav click -> ${text}`;
      // Map clicks to either dashboard or module fragments
      if(/class(es)?/i.test(text) && !/subject/i.test(text)){
        loadModule('classes');
      } else if(/subject/i.test(text)){
        loadModule('subjects');
      } else {
        showViewByName(text);
      }
    });
  });

  // Alert container
  const alertContainer = document.getElementById('alert-container');

  // Data arrays
  let classes = [
    { id: 1, name: 'Grade 1', teacher: 'Mr. John Smith', students: 30 },
    { id: 2, name: 'Grade 2', teacher: 'Ms. Jane Doe', students: 28 }
  ];

  let subjects = [
    { id: 1, name: 'Mathematics', classId: 1, teacher: 'Mr. John Smith' },
    { id: 2, name: 'English', classId: 1, teacher: 'Ms. Jane Doe' }
  ];

  // View elements
  // dashboardSection is the dashboard content; keep module container outside so we can hide/show dashboard independently
  const dashboardView = document.getElementById('dashboard-section');
  const moduleContainer = document.getElementById('module-container');
  // Note: module-specific elements (tables, add buttons) live inside the loaded fragments

  // Modals and form elements
  const classModalEl = document.getElementById('classModal');
  const classModal = new bootstrap.Modal(classModalEl);
  const classForm = document.getElementById('classForm');
  const classIdField = document.getElementById('classId');
  const classNameField = document.getElementById('className');
  const classTeacherField = document.getElementById('classTeacher');
  const classStudentsField = document.getElementById('classStudents');

  const subjectModalEl = document.getElementById('subjectModal');
  const subjectModal = new bootstrap.Modal(subjectModalEl);
  const subjectForm = document.getElementById('subjectForm');
  const subjectIdField = document.getElementById('subjectId');
  const subjectNameField = document.getElementById('subjectName');
  const subjectClassField = document.getElementById('subjectClass');
  const subjectTeacherField = document.getElementById('subjectTeacher');

  // Buttons (save buttons exist inside modals which are present in the main document)
  document.getElementById('saveClassBtn').addEventListener('click', saveClass);
  document.getElementById('saveSubjectBtn').addEventListener('click', saveSubject);

  // Initial render
  renderClassesTable();
  renderSubjectsTable();
  populateSubjectClassOptions();

  // Navigation: helper to show particular view
  function showViewByName(name){
    // hide all module views, show dashboard by default
    dashboardView.classList.toggle('d-none', true);
    // clear any loaded module
    if(moduleContainer) moduleContainer.innerHTML = '';
    // allow several names to map to views
    if(/dashboard/i.test(name)){
      dashboardView.classList.toggle('d-none', false);
    } else if(/class/i.test(name) && !/subject/i.test(name)){
      loadModule('classes');
    } else if(/subject/i.test(name)){
      loadModule('subjects');
    }
  }

  // Load external module fragment into #module-container then initialize handlers
  async function loadModule(name){
    try{
      // hide dashboard
      dashboardView.classList.add('d-none');
      if(!moduleContainer) return showAlert('Module container missing','danger');
      console.log('[ASMS] loadModule starting for', name);
      const dbg = document.getElementById('debug-area'); if(dbg) dbg.textContent = `loading module: ${name}`;
      let html = null;
      // Try fetching the fragment first
      try{
        const res = await fetch(`modules/${name}.html`);
        if(res.ok) html = await res.text();
      }catch(e){
        // fetch may fail on file:// or be blocked; we'll fallback below
        html = null;
      }
      // If fetch failed or returned nothing, use the embedded template fallback
      if(!html){
        html = getEmbeddedModuleTemplate(name);
        if(!html) throw new Error('Module not available');
      }
  moduleContainer.innerHTML = html;
  console.log('[ASMS] module injected for', name);
  if(dbg) dbg.textContent = `module injected: ${name}`;
      // After injecting module HTML, attach event handlers and re-render tables
      if(name === 'classes'){
        attachClassModuleHandlers();
        renderClassesTable();
      }
      if(name === 'subjects'){
        attachSubjectModuleHandlers();
        populateSubjectClassOptions();
        renderSubjectsTable();
      }
    }catch(err){
      showAlert('Failed to load module: '+err.message,'danger');
    }
  }

  // Provide embedded HTML templates as a fallback when fetching module files fails
  function getEmbeddedModuleTemplate(name){
    const templates = {
      classes: `
        <!-- Classes module (embedded fallback) -->
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h4>Classes</h4>
          <div>
            <button id="addClassBtn" class="btn btn-sm btn-primary">Add Class</button>
          </div>
        </div>
        <div class="card shadow-sm">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped" id="classesTable">
                <thead>
                  <tr>
                    <th>Class Name</th>
                    <th>Teacher</th>
                    <th>No. of Students</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </div>
        </div>
      `,
      subjects: `
        <!-- Subjects module (embedded fallback) -->
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h4>Subjects</h4>
          <div>
            <button id="addSubjectBtn" class="btn btn-sm btn-primary">Add Subject</button>
          </div>
        </div>
        <div class="card shadow-sm">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped" id="subjectsTable">
                <thead>
                  <tr>
                    <th>Subject Name</th>
                    <th>Class</th>
                    <th>Teacher</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </div>
        </div>
      `
    };
    return templates[name] || null;
  }

  // Attach handlers after classes module is loaded
  function attachClassModuleHandlers(){
    const addBtn = document.getElementById('addClassBtn');
    const tableBody = document.querySelector('#classesTable tbody');
    if(addBtn) addBtn.addEventListener('click', () => openClassModal());
    if(tableBody){
      tableBody.removeEventListener('click', onClassTableClick);
      tableBody.addEventListener('click', onClassTableClick);
    }
  }

  function onClassTableClick(e){
    const btn = e.target.closest('button');
    if(!btn) return;
    const action = btn.dataset.action;
    const id = Number(btn.dataset.id);
    if(action === 'edit-class') openClassModal(id);
    if(action === 'delete-class') deleteClass(id);
  }

  // Attach handlers after subjects module is loaded
  function attachSubjectModuleHandlers(){
    const addBtn = document.getElementById('addSubjectBtn');
    const tableBody = document.querySelector('#subjectsTable tbody');
    if(addBtn) addBtn.addEventListener('click', () => openSubjectModal());
    if(tableBody){
      tableBody.removeEventListener('click', onSubjectTableClick);
      tableBody.addEventListener('click', onSubjectTableClick);
    }
  }

  function onSubjectTableClick(e){
    const btn = e.target.closest('button');
    if(!btn) return;
    const action = btn.dataset.action;
    const id = Number(btn.dataset.id);
    if(action === 'edit-subject') openSubjectModal(id);
    if(action === 'delete-subject') deleteSubject(id);
  }

  // Rendering functions
  function renderClassesTable(){
    const tbody = document.querySelector('#classesTable tbody');
    if(!tbody) return; // table not loaded into DOM yet
    tbody.innerHTML = '';
    classes.forEach(c => {
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td>${escapeHtml(c.name)}</td>
        <td>${escapeHtml(c.teacher)}</td>
        <td>${c.students}</td>
        <td>
          <button class="btn btn-sm btn-outline-primary me-1" data-action="edit-class" data-id="${c.id}">Edit</button>
          <button class="btn btn-sm btn-outline-danger" data-action="delete-class" data-id="${c.id}">Delete</button>
        </td>
      `;
      tbody.appendChild(tr);
    });
  }

  function renderSubjectsTable(){
    const tbody = document.querySelector('#subjectsTable tbody');
    if(!tbody) return; // table not loaded into DOM yet
    tbody.innerHTML = '';
    subjects.forEach(s => {
      const cls = classes.find(c => c.id === s.classId);
      const className = cls ? cls.name : '—';
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td>${escapeHtml(s.name)}</td>
        <td>${escapeHtml(className)}</td>
        <td>${escapeHtml(s.teacher)}</td>
        <td>
          <button class="btn btn-sm btn-outline-primary me-1" data-action="edit-subject" data-id="${s.id}">Edit</button>
          <button class="btn btn-sm btn-outline-danger" data-action="delete-subject" data-id="${s.id}">Delete</button>
        </td>
      `;
      tbody.appendChild(tr);
    });
  }
  

  // CRUD operations for Classes
  function openClassModal(id){
    classForm.reset();
    classIdField.value = '';
    document.getElementById('classModalLabel').textContent = id ? 'Edit Class' : 'Add Class';
    if(id){
      const c = classes.find(x => x.id === id);
      if(!c) return showAlert('Class not found', 'danger');
      classIdField.value = c.id;
      classNameField.value = c.name;
      classTeacherField.value = c.teacher;
      classStudentsField.value = c.students;
    }
    classModal.show();
  }

  function saveClass(){
    const id = Number(classIdField.value) || null;
    const name = classNameField.value.trim();
    const teacher = classTeacherField.value.trim();
    const students = Number(classStudentsField.value) || 0;
    if(!name || !teacher){ return showAlert('Please fill all class fields','danger'); }
    if(id){
      const idx = classes.findIndex(x => x.id === id);
      if(idx === -1) return showAlert('Class not found','danger');
      classes[idx] = { id, name, teacher, students };
      showAlert('Class updated','success');
    } else {
      const nid = (classes.length ? Math.max(...classes.map(c=>c.id)) : 0) + 1;
      classes.push({ id: nid, name, teacher, students });
      showAlert('Class added','success');
    }
    classModal.hide();
    renderClassesTable();
    renderSubjectsTable(); // update subjects table in case class names changed
    populateSubjectClassOptions();
  }

  function deleteClass(id){
    if(!confirm('Delete this class? Subjects assigned to it will be kept but show a blank class.')) return;
    classes = classes.filter(c => c.id !== id);
    // update subjects referencing this class to classId = null
    subjects = subjects.map(s => s.classId === id ? { ...s, classId: null } : s);
    showAlert('Class deleted','success');
    renderClassesTable();
    renderSubjectsTable();
    populateSubjectClassOptions();
  }

  // CRUD operations for Subjects
  function openSubjectModal(id){
    subjectForm.reset();
    subjectIdField.value = '';
    document.getElementById('subjectModalLabel').textContent = id ? 'Edit Subject' : 'Add Subject';
    populateSubjectClassOptions();
    if(id){
      const s = subjects.find(x => x.id === id);
      if(!s) return showAlert('Subject not found','danger');
      subjectIdField.value = s.id;
      subjectNameField.value = s.name;
      subjectClassField.value = s.classId || '';
      subjectTeacherField.value = s.teacher;
    }
    subjectModal.show();
  }

  function saveSubject(){
    const id = Number(subjectIdField.value) || null;
    const name = subjectNameField.value.trim();
    const classId = subjectClassField.value ? Number(subjectClassField.value) : null;
    const teacher = subjectTeacherField.value.trim();
    if(!name || !teacher){ return showAlert('Please fill all subject fields','danger'); }
    if(id){
      const idx = subjects.findIndex(x => x.id === id);
      if(idx === -1) return showAlert('Subject not found','danger');
      subjects[idx] = { id, name, classId, teacher };
      showAlert('Subject updated','success');
    } else {
      const nid = (subjects.length ? Math.max(...subjects.map(s=>s.id)) : 0) + 1;
      subjects.push({ id: nid, name, classId, teacher });
      showAlert('Subject added','success');
    }
    subjectModal.hide();
    renderSubjectsTable();
  }

  function deleteSubject(id){
    if(!confirm('Delete this subject?')) return;
    subjects = subjects.filter(s => s.id !== id);
    showAlert('Subject deleted','success');
    renderSubjectsTable();
  }

  // Utilities
  function populateSubjectClassOptions(){
    subjectClassField.innerHTML = '<option value="">(Unassigned)</option>' + classes.map(c=>`<option value="${c.id}">${escapeHtml(c.name)}</option>`).join('');
  }

  function showAlert(message, type = 'success', timeout = 3000){
    const wrapper = document.createElement('div');
    wrapper.innerHTML = `<div class="alert alert-${type} alert-dismissible" role="alert">${escapeHtml(message)}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`;
    alertContainer.appendChild(wrapper);
    if(timeout) setTimeout(()=>{ try{ wrapper.remove(); } catch(e){} }, timeout);
  }

  function escapeHtml(unsafe){
    return String(unsafe)
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;')
      .replace(/'/g, '&#039;');
  }

  // Expose a small debug API for the console (temporary)
  try{
    window._ASMS = {
      loadModule,
      renderClassesTable,
      renderSubjectsTable,
      data: {
        classes,
        subjects
      }
    };
    console.log('[ASMS] debug API available as window._ASMS');
    const dbg = document.getElementById('debug-area'); if(dbg) dbg.textContent = 'debug: window._ASMS ready';
  }catch(e){ /* ignore in strict environments */ }

  // Initially show dashboard
  showViewByName('Dashboard');
});
