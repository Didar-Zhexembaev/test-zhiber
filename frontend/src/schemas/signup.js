import * as yup from "yup";
import signin from "./signin";

const schema = yup.object({
    name: yup.string().min(3, "ФИО должен быть не менее 3 символов").required("ФИО обязательное поле"),
    ...signin,
    confirmPassword: yup
        .string()
        .required("Подтвердить пароль является обязательным полем")
        .oneOf([yup.ref("password"), null], "Пароли должны совпадать"),
});

export default schema;