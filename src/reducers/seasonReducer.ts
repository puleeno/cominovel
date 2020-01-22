import { AnyAction } from "redux";
import { FETCH_SEASONS_FULLFILLED } from "../actions/types";
import { ISeason } from "../interfaces/CominovelProps";

export function seasons(previewState: ISeason[] = [], action: AnyAction) {
    if (action.type === FETCH_SEASONS_FULLFILLED) {
        return action.payload;
    }

    return previewState;
}
