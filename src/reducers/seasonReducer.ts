import { AnyAction } from "redux";
import { FETCH_SEASONS_FULLFILLED } from "../actions/types";
import { ISeason } from "../interfaces/CominovelProps";

export interface ISeasonState {
    seasons: ISeason[];
}

const initState: ISeasonState = {
    seasons: [],
};

export function seasons(previewState: ISeasonState = initState, action: AnyAction) {
    if (action.type === FETCH_SEASONS_FULLFILLED) {
        return action.payload;
    }
    return previewState;
}
