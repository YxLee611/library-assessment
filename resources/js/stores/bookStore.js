import { defineStore } from 'pinia';
import axios from 'axios';

export const useBookStore = defineStore('book', {
    state: () => ({
        allBooks: []
    }),

    actions: {
        async fetchAllBooks() {
            try {
                const response = await axios.get('/api/books');
                this.allBooks = response.data.books;
                console.log(this.allBooks)
            } catch (error) {
                console.error('Failed to fetch all books:', error);
            }
        }
    }
});
