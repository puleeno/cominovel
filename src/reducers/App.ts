import { ActionType } from "typesafe-actions";
import { setAppStatus } from "../actions";
import { IS_LOADED } from "../actions/types";

type Action = ActionType<typeof setAppStatus>;

export const appState = (state: {}, action: Action) => {
    switch (action.type) {
        case IS_LOADED: {
            return action.payload;
        }
        default: {
            return state;
        }
    }
};
