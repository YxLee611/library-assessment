<template>
    <table>
        <tr>
            <th v-for="header in headers" :key="header">{{ header }}</th>
        </tr>
        <tr v-for="(row, index) in rows" :key="index">
            <td v-for="(item, key) in row" :key="key">{{ item }}</td>
            
            <template v-if="isAdmin">
                <td @click="editBook(row)">
                    <i class="fa-regular fa-pen-to-square"></i>
                </td>
            </template>
            <template v-else>
                <td @click="openBorrowBookModal(row)">
                    <i class="fa-solid fa-square-plus"></i>
                </td>
            </template>
        </tr>
    </table>
</template>

<script>
import { useUserStore } from '@/stores/userStore';
import { ref, computed } from 'vue';

export default {
    props: {
        headers: Array,
        rows: Array
    },

    setup(props, context) {
        const userStore = useUserStore();
        const isAdmin = computed(() => userStore.user?.role_id === 1);
        const showModal = ref(false);

        const editBook = (row) => {
            // Perform action to edit book (e.g., redirect to edit book page)
        };

        const openBorrowBookModal = (row) => {
            const { id, title, author } = row;
            const { name, email } = userStore.user;

            const payload = {
                showModal: true,
                bookId: id,
                bookTitle: title,
                bookAuthor: author,
                userName: name,
                userEmail: email
            };
            
            context.emit('toggle-modal', payload);
            // Perform action to open borrow book modal
        };

        return {
            isAdmin,
            showModal,
            editBook,
            openBorrowBookModal
        };
    }
};
</script>

<style lang="scss" scoped>
    table {
        border-collapse: collapse;
        width: 100%;

        td, th {
            border: 1px solid var(--grey1);
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: var(--grey3);
        }

        th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color:  var(--blue2);
            color: var(--white);
        }

        td:last-child, th:last-child {
            text-align: center;
        }
    }
</style>
