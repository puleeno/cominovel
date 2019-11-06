import { AnyAction } from "redux";
import { IS_LOADED } from "../actions/types";

export interface IAppState {
    readonly isLoaded: boolean | null;
}

const initState: IAppState = {
    isLoaded: null,
};

export const appState = (previousState: IAppState = initState, action: AnyAction): IAppState => {
    switch (action.type) {
        case IS_LOADED: {
            return {
                ...previousState,
                isLoaded: action.payload,
            };
        }
        default: {
            return previousState;
        }
    }
};
