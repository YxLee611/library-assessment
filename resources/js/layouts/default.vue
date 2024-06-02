<template>
    <div>
        <header>
            <nav class="navbar">
                <div class="library-name">
                    <div class="book-icon">
                        <i class="fa-solid fa-book"></i>
                    </div>
                    <p>Library Test</p>
                </div>

                <div class="user-name">
                    <p>User Name</p>
                </div>
            </nav>
        </header>
        <main>
            <nav class="sidebar">
                <ul class="sidebar-menu">
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#">Books</a></li>
                    <li><a href="#">Users</a></li>
                    <li><a href="#">Resources</a></li>
                    <li><a href="#">Reports</a></li>
                    <li><a href="#">Settings</a></li>
                </ul>
            </nav>
            <div class="dashboard-container">
                <slot></slot>
            </div>
        </main>
    </div>
</template>

<script>
export default {
    name: 'DefaultLayout'
}
</script>