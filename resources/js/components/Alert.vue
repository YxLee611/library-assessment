<template>
    <div :class="['alert-wrapper', type]">
        <p v-html="message"></p>
    </div>
</template>

<script>
export default {
    props: {
        type: String,
        message: String
    },
    setup(props) {
        return {
            type: props.type,
            message: props.message
        };
    }
};
</script>

<style lang="scss" scoped>
.alert-wrapper{
    padding: 16px;
    border-radius: 8px;
    position: absolute;
    right: 16px;
    top: 16px;

    &.error {
        background-color: var(--red1);
        border: 1px solid var(--red2);
    }

    &.success {
        background-color: var(--green1);
        border: 1px solid var(--green2);
    }

    p {
        font-size: 14px;
    }
}
</style>