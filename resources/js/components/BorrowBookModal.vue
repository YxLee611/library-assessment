<template>
    <div class="modal" v-if="modalProps.showModal" :class="{ 'open': modalProps.showModal }">
        <div class="modal__content">
            <h1>Borrow Book Confirmation</h1>

            <p>
                Hi <span>{{modalProps.userName}}</span>, are you sure to borrow <span>{{modalProps.bookTitle}}</span> ?
            </p>

            <div class="modal__footer">
                <button @click="confirmBorrow">OK</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        modalProps: Object
    },

    setup(props, context) {
        const confirmBorrow = () => {
            context.emit('close-modal');
        };

        return {
            confirmBorrow
        };
    }
};
</script>

<style lang="scss" scoped>
    .modal {
        visibility: hidden;
        opacity: 0;
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(77, 77, 77, .7);
        transition: all .4s;

        &.open {
            visibility: visible;
            opacity: 1;
        }

        .modal__content {
            border-radius: 4px;
            position: relative;
            width: 500px;
            max-width: 90%;
            background: var(--white);
            padding: 24px 32px;

            h1 {
                margin-bottom: 20px;
            }

            p {
                span {
                    font-weight: 600;
                }
            }
        }

        .modal__footer {
            text-align: right;
            margin-top: 40px;
            
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
    }
</style>