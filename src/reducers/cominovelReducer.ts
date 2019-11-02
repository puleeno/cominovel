import { AnyAction } from "redux";
import { FETCH_COMINOVEL_FULLFILLED } from "../actions/types";
import { ICominovelInfo } from "../interfaces/CominovelProps";

export interface ICominovelState {
    info: ICominovelInfo;
}

const initState: ICominovelState = {
    info: {},
};

export function cominovelInfo(previewState: ICominovelState = initState, action: AnyAction): ICominovelState {
    switch (action.type) {
        case FETCH_COMINOVEL_FULLFILLED: {
            const newState = {
                ...previewState,
                info: action.payload,
            };
            return newState;
        }
        default: {
            return previewState;
        }
    }
}
