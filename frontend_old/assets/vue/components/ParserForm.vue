<template>
    <form>
        <div class="form-group">
            <label for="file-for-parsing">Put here the file for transactions parsing:</label>
            <input type="file" class="form-control-file" id="file-for-parsing">
        </div>
        <div class="form-group">
            <label for="parsing-date-from">Start parsing from date:</label>
            <input type="date" class="form-control-file" id="parsing-date-from">
        </div>
        <div class="form-group">
            <label for="parsing-date-to">Stop parsing on date:</label>
            <input type="date" class="form-control-file" id="parsing-date-to">
        </div>
    </form>
</template>

<script>
    export default {
        name: "ParserForm",
        data() {
            return {
                dateFrom: "",
                dateTo: null,
                file: ""
            };
        },
    }
</script>

<style scoped>

</style>