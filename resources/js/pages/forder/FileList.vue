<template>
    <div class="px-2">
        <div class="file-item mt-0" style="display: flex;" v-for="file in files">
            <div class="image-item pt-2" style="width: 52px;height 67px;background:;">
                <img :src="`/images/icons/${file.type}.svg`" />
            </div>
            <div class="pt-2 px-2" style="width: calc(100% - 80px); background: ">
                <p class="mt-1" style="font-size: 90%; font-weight: 600" @click="viewFile(file)">
                    {{ file.name }}
                </p>

                <p class="mt-1" style="font-size: 85%; font-weight: 500; opacity: 0.5">
                    {{ file.created_at }}
                </p>
            </div>
            <div class="pt-2" style="width: 20px; height: 67px; background: ">
                <i @click="$event => download(file.id, file.name)" class="fa fa-cloud-download text-blue-600 mt-1"
                    aria-hidden="true"></i>
                <i @click="$event => deleteFile(file.id)" class="fa fa-trash text-red-600 mt-2" aria-hidden="true"
                    style="margin-left: 2px"></i>
            </div>
        </div>
    </div>
    <!-- anytime ukanzeho ivaho with closeModal -->
    <!-- <div v-if="currentFileUrl" class="file-viewer-modal" @click="closeModal">
        <div class="close-button" @click="closeModal">X</div>
        <iframe :src="currentFileUrl" frameborder="0"></iframe>
    </div> -->

    <div v-if="currentFileUrl" class="file-viewer-modal" @click="closeModal">
            <div class="file-name">{{ currentFileName }}</div> <!-- This is the new line -->
            <div class="close-button" @click="closeModal">X</div>
            <iframe :src="currentFileUrl" frameborder="0"></iframe>
    </div>

    <input type="file" ref="uploadFile" @change="handleFileChange" style="display: none;">
    <div @click="openDialog" class="text-center" style="
            width: 50px;
            height: 50px;
            background: blue;
            border-radius: 50%;
            position: fixed;
            right: 5px;
            bottom: 5vh;
            cursor: pointer;
        ">
        <i class="fa fa-cloud-upload" aria-hidden="true" style="font-size: 140%; line-height: 48px; color: white"></i>
    </div>
</template>
<script>
export default {
    data() {
        return {
            files: [],
            selectedFile: null,
            currentFileUrl: null,
            currentFileName: '',
        }
    },
    created: function () {
        this.getData();
    },
    watch: {
        selectedFile() {
            this.uploadFile();
        }
    },
    methods: {
        async getData() {
            try {
                const { data } = await axios.get('/api/file/get-data/' + this.$route.params.id);
                this.files = data;
            } catch (error) {
                console.log(error)
            }
        },
        handleFileChange(event) {
            this.selectedFile = event.target.files[0];
        },
        openDialog() {
            const elem = this.$refs.uploadFile;
            elem.click()
        },
        async uploadFile() {
            const formData = new FormData();
            formData.append('file', this.selectedFile);
            try {
                const { data } = await axios.post('/api/file/upload/' + this.$route.params.id, formData);
                this.getData();
            } catch (error) {
                console.log(error);
                Swal.fire(error?.response?.data?.message);
            }
        },
        download(id, name) {
            axios.get('/api/file/download/' + id, { responseType: 'blob' })
                .then(response => {
                    const url = window.URL.createObjectURL(new Blob([response.data]));
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', name);
                    document.body.appendChild(link);
                    link.click();
                })
                .catch(error => {
                    console.log(error);
                })
        },
        async deleteFile(id) {
            try {
                const { data } = await axios.get('/api/file/delete/' + id);
                if (data) {
                    this.getData();
                }
            } catch (error) {
                //console.log(error);
                Swal.fire(error?.response?.data?.message);
            }
        },
        viewFile(file) {
            if (['png', 'jpg', 'jpeg', 'pdf'].includes(file.type)) {
                // For images, we can open them in a new tab
                //window.open('/api/file/download/' + file.id, '_blank');
                this.currentFileUrl = '/api/file/download/' + file.id + '/view';
                this.currentFileName = file.name;
            } else if (file.type === 'txt') {
                // For text files, we can fetch the content and display in a modal or an alert
                axios.get('/api/file/download/' + file.id)
                    .then(response => {
                        // For simplicity, we'll use an alert. Consider using a modal for better UX.
                        alert(response.data);
                    })
                    .catch(error => {
                        console.log(error);
                    });
            } else {
                // For other file types, you can extend this logic. For now, we'll show a message.
                alert('This file type cannot be previewed.');
            }
        },

        closeModal() {
            this.currentFileUrl = null;
        }
    }
}
</script>

<style scoped>
.file-viewer-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1000;
    display: flex;
    justify-content: center;
    align-items: center;
}

iframe {
    width: 80%;
    height: 80%;
}

.viewer-container {
    position: relative;
    width: 80%;
    height: 80%;
}

.close-button {
    position: absolute;
    top: 50px;
    right: 175px;
    background-color: #fff;
    padding: 5px 10px;
    cursor: pointer;
    border-radius: 5px;
    font-weight: bold;
    z-index: 2;
}
.file-name {
    position: absolute;
    top: 54px;   /* Adjust as needed it doesn't matter cyereka boss damour nansaba gukora change*/
    left: 51%;
    transform: translateX(-50%);
    background-color: #fff;
    padding: 5px 10px;
    border-radius: 5px;
    font-weight: bold;
    z-index: 2; /* Ensure it appears above the iframe */
}
</style>
