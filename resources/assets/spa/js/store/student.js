import classInformation from './student/class_information';
import classTeaching from './student/class_teaching';
import classTest from './student/class_test';
import studentClassTest from './student/student_class_test';

const module = {
    namespaced: true,
    modules: {
        classInformation, classTeaching, classTest,studentClassTest
    }
};

export default module;