import { ISeasonState } from "../reducers/seasonReducer";
import { FETCH_SEASONS, FETCH_SEASONS_FULLFILLED } from "./types";

export function fetchSeasons(id: number) {
    return {
        payload: id,
        type: FETCH_SEASONS,
    };
}

export function fetchSeasonsFullFilled(seasons: ISeasonState) {
    return {
        payload: seasons,
        type: FETCH_SEASONS_FULLFILLED,
    };
}
