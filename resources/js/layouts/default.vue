<template>
    <div>
        <header>
            <p>tetstt</p>
            <!-- You can include a header here if needed -->
        </header>
        <main>
            <slot></slot>
        </main>
        <footer>
            <!-- You can include a footer here if needed -->
        </footer>
    </div>
</template>

<script>
export default {
    name: 'DefaultLayout'
}
</script>