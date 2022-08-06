export default {
    methods: {
        getImageURL(image, ext = 'jpg') {
            return `${import.meta.env.BASE_URL}src/assets/img/${image}.${ext}`;
        },
    }
};