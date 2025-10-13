<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ASMS Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- Sidebar -->
  <div class="d-flex">
    <div class="sidebar p-3">
      <div class="sidebar-profile d-flex flex-column align-items-center mb-3">
        <div class="avatar" aria-hidden="true">MA</div>
        <div class="profile-name mt-2">Mathew Amanyire</div>
        <div class="profile-role">Administrator</div>
      </div>
      <ul class="nav flex-column">
        <li class="nav-item"><a href="#" class="nav-link active">Dashboard</a></li>
        <li class="nav-item"><a href="#" class="nav-link">Students</a></li>
        <li class="nav-item dropdown-sub">
          <a href="#" class="nav-link" aria-haspopup="true" aria-expanded="false">Classes <span class="caret">▾</span></a>
          <ul class="dropdown-submenu list-unstyled" role="menu">
            <li>
              <a href="#" class="nav-link sub-link" role="menuitem">
                <!-- Book / classes icon -->
                <svg class="icon" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                  <path d="M3 6l9-4 9 4v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V6z" fill="currentColor"/>
                </svg>
                Classes Module
              </a>
            </li>
            <li>
              <a href="#" class="nav-link sub-link" role="menuitem">
                <!-- List / subjects icon -->
                <svg class="icon" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                  <path d="M3 7h18v2H3V7zm0 6h18v2H3v-2z" fill="currentColor"/>
                </svg>
                Subjects Module
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item"><a href="#" class="nav-link">Marks</a></li>
        <li class="nav-item"><a href="#" class="nav-link">Teachers</a></li>
        <li class="nav-item"><a href="#" class="nav-link">Reports</a></li>
      </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content flex-grow-1">
      <nav class="navbar navbar-light bg-light justify-content-between px-4">
        <span class="navbar-brand mb-0 h4">Administrative Student Management System</span>
        <div>
        <!-- Modals -->
        <div class="modal fade" id="classModal" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="classModalLabel">Add Class</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form id="classForm">
                  <input type="hidden" id="classId">
                  <div class="mb-3">
                    <label class="form-label">Class Name</label>
                    <input id="className" class="form-control" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Teacher</label>
                    <input id="classTeacher" class="form-control" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Number of Students</label>
                    <input id="classStudents" type="number" class="form-control" min="0" required>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button id="saveClassBtn" type="button" class="btn btn-primary">Save</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="subjectModal" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="subjectModalLabel">Add Subject</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form id="subjectForm">
                  <input type="hidden" id="subjectId">
                  <div class="mb-3">
                    <label class="form-label">Subject Name</label>
                    <input id="subjectName" class="form-control" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Class</label>
                    <select id="subjectClass" class="form-select" required></select>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Teacher</label>
                    <input id="subjectTeacher" class="form-control" required>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button id="saveSubjectBtn" type="button" class="btn btn-primary">Save</button>
              </div>
            </div>
          </div>
        </div>

  </div>
      </nav>

      <div class="container-fluid p-4">
        <!-- Alert container for success/error messages -->
  <div id="alert-container"></div>
  <!-- Temporary debug area (remove when resolved) -->
  <div id="debug-area" style="font-family:monospace; font-size:12px; color:#660000; margin-top:8px;"></div>

        <!-- Views container: dashboard remains default, modules inserted here -->
        <div id="view-container">
          <!-- Dashboard (existing content kept) -->
          <div id="dashboard-section">
        <!-- Summary Cards -->
        <div class="row g-3 mb-4">
          <div class="col-md-3">
            <div class="card text-center shadow-sm card-accent card-students">
              <div class="card-body">
                <h5>Total Students</h5>
                <h2>1,245</h2>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card text-center shadow-sm card-accent card-teachers">
              <div class="card-body">
                <h5>Total Teachers</h5>
                <h2>42</h2>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card text-center shadow-sm card-accent card-classes">
              <div class="card-body">
                <h5>Total Classes</h5>
                <h2>12</h2>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card text-center shadow-sm card-accent card-subjects">
              <div class="card-body">
                <h5>Total Subjects</h5>
                <h2>8</h2>
              </div>
            </div>
          </div>
        </div>
          </div>
        <!-- Module container: external module fragments will load here -->
        <div id="module-container"></div>


        <!-- Updates and Notices -->
        <div class="row g-3">
          <div class="col-md-8">
            <div class="card shadow-sm">
              <div class="card-header fw-bold bg-light">Recent Updates</div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-borderless table-hover recent-table align-middle">
                    <thead>
                      <tr>
                        <th>Student</th>
                        <th>Type</th>
                        <th>Details</th>
                        <th>Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>John Doe</td>
                        <td><span class="badge bg-primary-light text-primary">New</span></td>
                        <td>Registered for Form 3</td>
                        <td>2025-09-24</td>
                      </tr>
                      <tr>
                        <td>Jane Smith</td>
                        <td><span class="badge bg-success-light text-success">Result</span></td>
                        <td>Topper: Biology - 95%</td>
                        <td>2025-09-20</td>
                      </tr>
                      <tr>
                        <td>Robert Johnson</td>
                        <td><span class="badge bg-warning-light text-warning">Pending</span></td>
                        <td>Report card pending (Math)</td>
                        <td>2025-09-18</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card shadow-sm">
              <div class="card-header fw-bold bg-light">Short Notices</div>
              <div class="card-body">
                <h6 class="fw-bold">Upcoming Term</h6>
                <p>Next term begins on February 15, 2026.</p>
                <hr>
                <h6 class="fw-bold">Parent Meeting</h6>
                <p>Parent meeting scheduled on February 22, 2026.</p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="script.js"></script>
</body>
</html>
