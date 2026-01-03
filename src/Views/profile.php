<?php include 'includes/header.php'; ?>

<body>

    <!-- Topbar -->
    <nav class="navbar navbar-expand-lg topbar fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand text-accent" href="index">Acme Identity</a>

            <div class="d-flex align-items-center gap-2">
                <span class="muted small">Welcome, <?php echo htmlspecialchars($_SESSION['profile']['name'] ?? 'User'); ?></span>
                <a href="logout" class="btn btn-outline-primary btn-sm">Log out</a>
                <button class="btn btn-sm theme-toggle" id="themeToggle">Toggle Theme</button>
            </div>
        </div>
    </nav>

    <!-- Main shell: sidebar + content -->
    <div class="container-fluid" style="padding-top:80px;">
        <div class="app-shell">

            <!-- Sidebar -->
            <aside class="sidebar">
                <div class="brand">Acme Identity</div>
                <p class="muted small mb-3">User Portal</p>

                <nav>
                    <a href="profile" class="active">Profile</a>
                    <a href="admin/admin">Dashboard</a>
                    <a href="settings">Settings</a>
                    <a href="help">Help & Support</a>
                </nav>

                <hr>
                <div class="small muted">Theme</div>
                <div class="mt-2">
                    <button class="btn btn-sm theme-toggle w-100" id="sideThemeToggle">Toggle Theme</button>
                </div>
            </aside>

            <!-- Content -->
            <section class="content">

                <!-- Header card -->
                <div class="card-surface d-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="mb-0">My Profile</h4>
                        <p class="muted small mb-0">View and manage your personal information.</p>
                    </div>
                </div>

                <!-- Profile Information Card -->
                <div class="card-surface">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0">Personal Information</h5>
                        <a href="profile/edit" class="btn btn-primary btn-sm">Edit Profile</a>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="mb-3">
                                <label class="form-label text-muted small">Full Name</label>
                                <p class="mb-0 fw-500"><?php echo htmlspecialchars($_SESSION['profile']['name'] ?? 'N/A'); ?></p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="mb-3">
                                <label class="form-label text-muted small">Email Address</label>
                                <p class="mb-0 fw-500"><?php echo htmlspecialchars($_SESSION['profile']['email'] ?? 'N/A'); ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="mb-3">
                                <label class="form-label text-muted small">Role</label>
                                <p class="mb-0">
                                    <span class="badge" style="background-color: var(--accent); color: white;">
                                        <?php echo htmlspecialchars($_SESSION['profile']['role'] ?? 'User'); ?>
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="mb-3">
                                <label class="form-label text-muted small">Member Since</label>
                                <p class="mb-0 fw-500">
                                    <?php
                                    if (isset($_SESSION['profile']['created_at'])) {
                                        echo date('F d, Y', strtotime($_SESSION['profile']['created_at']));
                                    } else {
                                        echo 'N/A';
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Account Security Card -->
                <div class="card-surface">
                    <h5 class="mb-4">Account Security</h5>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-1 fw-500">Password</p>
                                    <p class="muted small mb-0">Change your password regularly</p>
                                </div>
                                <a href="profile/change-password" class="btn btn-outline-primary btn-sm">Change</a>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-1 fw-500">Two-Factor Authentication</p>
                                    <p class="muted small mb-0">Add an extra layer of security</p>
                                </div>
                                <a href="profile/2fa" class="btn btn-outline-primary btn-sm">Enable</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Activity Card -->
                <div class="card-surface">
                    <h5 class="mb-4">Recent Activity</h5>

                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>Activity</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Profile accessed</td>
                                <td><?php echo date('M d, Y H:i'); ?></td>
                                <td><span class="badge bg-success">Active</span></td>
                            </tr>
                            <tr>
                                <td>Account created</td>
                                <td><?php
                                    if (isset($_SESSION['profile']['created_at'])) {
                                        echo date('M d, Y H:i', strtotime($_SESSION['profile']['created_at']));
                                    } else {
                                        echo 'N/A';
                                    }
                                    ?></td>
                                <td><span class="badge bg-success">Completed</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Danger Zone -->
                <div class="card-surface" style="border-color: var(--danger); border: 1px solid var(--danger);">
                    <h5 class="mb-3" style="color: var(--danger);">Danger Zone</h5>

                    <div class="d-grid gap-2">
                        <a href="profile/delete" class="btn btn-outline-danger">Delete Account</a>
                    </div>
                    <p class="muted small mt-3 mb-0">This action cannot be undone. Please be certain.</p>
                </div>

            </section>

        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

    <script>
        // Theme toggle functionality
        const themeToggle = document.getElementById('themeToggle');
        const sideThemeToggle = document.getElementById('sideThemeToggle');

        const toggleTheme = () => {
            const html = document.documentElement;
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
        };

        themeToggle?.addEventListener('click', toggleTheme);
        sideThemeToggle?.addEventListener('click', toggleTheme);

        // Load saved theme
        const savedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', savedTheme);
    </script>

</body>

</html>