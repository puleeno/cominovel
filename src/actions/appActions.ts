import { IS_LOADED } from "../actions/types";

export const setAppStatus = (status: boolean) => ({
    payload: status,
    type   : IS_LOADED,
});
