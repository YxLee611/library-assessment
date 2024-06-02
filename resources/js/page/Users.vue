<template>
    <div class="title-wrapper">
        <h1>Users</h1>

        <button>Add New User</button>
    </div>
   
    <Table :headers="tableHeaders" :rows="filteredUsers"></Table>
</template>

<script>
import { useUserStore } from '@/stores/userStore';
import { onMounted, computed } from 'vue';
import Table from '@/components/Table.vue'; 

export default {
    components: {
        Table
    },
    setup() {
        const userStore = useUserStore();

        onMounted(() => {
            userStore.fetchAllUsers();
        });

        const allUsers = computed(() =>  userStore.allUsers);
        const tableHeaders = ['Name', 'Email', 'Role']; 
        const filteredUsers = computed(() => {
            return allUsers.value.map(user => ({
                name: user.name,
                email: user.email,
                role: user.role ? user.role.name : '' 
            }));
        });

        return {
            allUsers,
            tableHeaders,
            filteredUsers
        };
    }
};
</script>

<style lang="scss" scoped>
    .title-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;


        button {
            background-color: var(--darkgrey1);
            color: var(--white);
            border: none;
            border-radius: 15px;
            padding: 14px 16px;
        }
    }
   
</style>