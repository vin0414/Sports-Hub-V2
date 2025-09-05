const dropzone = document.getElementById('dropzone');
const fileInput = document.getElementById('fileInput');
const uploadForm = document.getElementById('frmUpload');
let isUploading = false; // To track if a file is being uploaded

// Show file input when the dropzone is clicked
dropzone.addEventListener('click', () => {
    fileInput.click();
});

// Handle dragover event to show visual feedback
dropzone.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropzone.classList.add('dragover');
});

// Remove the visual feedback when dragging leaves the dropzone
dropzone.addEventListener('dragleave', () => {
    dropzone.classList.remove('dragover');
});

// Handle file drop
dropzone.addEventListener('drop', (e) => {
    e.preventDefault();
    dropzone.classList.remove('dragover');
    const files = e.dataTransfer.files;
    handleFiles(files);
});

// Handle file selection through file input
fileInput.addEventListener('change', () => {
    const files = fileInput.files;
    handleFiles(files);
});

// Function to handle the files (allowing only one file upload at a time)
function handleFiles(files) {
    if (isUploading) {
        alert('A file is already being uploaded. Please wait until the upload is complete.');
        return;
    }

    if (files.length > 0) {
        const file = files[0]; // Only process the first file
        const fileType = file.type;
        const fileName = file.name;

        if (fileType === 'application/x-zip-compressed' || fileType === 'application/pdf') {
            isUploading = true; // Set the uploading flag to true
            console.log(`Uploading: ${fileName}`);

            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            fileInput.files = dataTransfer.files;

            // Simulate file upload (replace with real upload logic)
            simulateUpload(file);
        } else {
            alert(`Invalid file type: ${fileName}. Only .zip and .pdf files are allowed.`);
        }
    }
}

// Simulate the file upload process
function simulateUpload(file) {
    setTimeout(() => {
        // After simulating upload (replace with actual server upload logic)
        console.log(`File uploaded successfully: ${file.name}`);
        isUploading = false; // Reset the uploading flag
        uploadForm.submit();
    }, 2000); // Simulate a 2-second upload process (you can adjust this
}

