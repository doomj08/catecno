<template>
    <div class="file-upload">
        <input type="file" @change="onFileChange"
               v-on:input="$emit('input', $event.target.value)"
        />
    </div>
</template>

<script>
    export default {
        data() {
            return {
                selectedFile: "",
            };
        },
        methods: {
            onFileChange(e) {
                const selectedFile = e.target.files[0]; // accessing file
                this.selectedFile = selectedFile;
                this.$emit('fileupdate', selectedFile)  // 1. Emitting
            },
            onUploadFile() {
                const formData = new FormData();
                formData.append("file", this.selectedFile);  // appending file
                console.log(formData)

                // sending file to the backend
                axios
                    .post("http://localhost:4500/upload", formData)
                    .then(res => {
                        console.log(res);
                    })
                    .catch(err => {
                        console.log(err);
                    });
            }
        }
    };
</script>