import classInformation from './teacher/class_information';
import classTeaching from './teacher/class_teaching';
import classTest from './teacher/class_test';

const module = {
    namespaced: true,
    modules: {
        classInformation, classTeaching, classTest
    }
};

export default module;