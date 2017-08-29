import Vue from 'vue';

Vue.filter('dateBr', function (value) { //0000-00-00
    if (value && value.length >= 10) {
        let dateArray = value.substring(0, 10).split('-');
        if (dateArray.length === 3) {
            return dateArray.reverse().join('/');
        }
    }
    return value;
});

Vue.filter('dateTimeBr', function (value) { //0000-00-00
    if (value && value.length >= 16) {
        let dateArray = value.substring(0, 10).split('-');
        if (dateArray.length === 3) {
            return dateArray.reverse().join('/').replace('T','');
        }
    }
    return value;
});

Vue.filter('classInformationAlias', function(classInformation){
    return `${classInformation.cycle}.${classInformation.subdivision}.${classInformation.semester}.${classInformation.year}`;
})