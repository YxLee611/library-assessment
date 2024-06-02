<template>
    <table>
        <tr>
            <th v-for="header in headers" :key="header">{{ header }}</th>
        </tr>
        <tr v-for="(row, index) in rows" :key="index">
            <td v-for="(item, key) in row" :key="key">{{ item }}</td>
        </tr>
    </table>
</template>

<script>
export default {
    props: {
        headers: Array,
        rows: Array
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
    }
</style>
