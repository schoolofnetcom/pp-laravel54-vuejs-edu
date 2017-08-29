import store from '../store/store';

export default {
    computed: {
        classTeaching() {
            return store.state[this.storeType].classTeaching.classTeaching;
        },
        classInformation() {
            return !this.classTeaching ? null : this.classTeaching.class_information;
        },
        classInformationName() {
            if(this.classInformation){
                let classInformationAlias = this.$options.filters.classInformationAlias(this.classInformation);
                return `${classInformationAlias} - ${this.classTeaching.subject.name}`;
            }

            return '';
        },
    }
}