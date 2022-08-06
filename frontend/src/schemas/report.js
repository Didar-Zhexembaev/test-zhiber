import * as yup from "yup";
import store from '../store';

const schema = yup.object({
    from: yup.string().required("Откуда обязательное поле"),
    to: yup
        .string()
        .required("Куда обязательное поле")
        .notOneOf([yup.ref("from"), null], "Откуда и Куда не должны совпадать"),
    transportType: yup.string().required("Тип транспорта обязательное поле"),
    departureType: yup.string().required("Тип отправления обязательное поле"),
    weight: yup.string().test("required", "Вес  обязательное поле",
        (value, ctx) => ctx.parent.departureType != store.getters.getPackageIndex || value),
    dateTime: yup.string().required("Дата и время поездки  обязательное поле"),
});

export default schema;