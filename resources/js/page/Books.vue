<template>
    <div class="title-wrapper">
        <h1>Books</h1>

        <button>Add New Book</button>
    </div>
   
    <Table :headers="tableHeaders" :rows="filteredBooks" @toggle-modal="updateShowModal"></Table>
    <BorrowBookModal :modalProps="modalProps" @close-modal="updateShowModal"></BorrowBookModal>
</template>

<script>
import { useBookStore } from '@/stores/bookStore';
import { onMounted, computed, ref } from 'vue';
import Table from '@/components/Table.vue';
import BorrowBookModal from '@/components/BorrowBookModal.vue'; 

export default {
    components: {
        Table,
        BorrowBookModal
    },
    setup() {
        const bookStore = useBookStore();
        const modalProps = ref({});

        const updateShowModal = (value) => {
            modalProps.value = value;
        };

        onMounted(() => {
            bookStore.fetchAllBooks();
        });

        const allBooks = computed(() =>  bookStore.allBooks);
        const tableHeaders = ['Title', 'Author', 'Genre', 'Date of Publication', 'Action']; 
        const filteredBooks = computed(() => {
            return allBooks.value.map(book => ({
                title: book.title,
                author: book.author,
                genre: book.category ? book.category.name : '',
                date: book.date_of_publication,
            }));
        });

        return {
            allBooks,
            tableHeaders,
            filteredBooks,
            modalProps,
            updateShowModal,
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

            &:hover {
                cursor: pointer;
            }
        }
    }
   
</style>