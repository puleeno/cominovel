import { fetchSeasonsFullFilled } from "../actions";
import { FETCH_SEASONS_FULLFILLED } from "../actions/types";
import { ISeason } from "../interfaces/CominovelProps";

export interface ISeasonState {
    seasons: ISeason[];
}

type SeasonAction = ReturnType<typeof fetchSeasonsFullFilled>;

export function seasons(previewState: ISeasonState, action: SeasonAction) {
    if (action.type === FETCH_SEASONS_FULLFILLED) {
        return action.payload;
    }
    return previewState;
}
