import { AnyAction } from "redux";
import { IS_LOADED } from "../actions/types";

export interface IAppState {
    readonly isLoaded: boolean;
}

const initState: IAppState = {
    isLoaded: false,
};

export const appState = (previousState: IAppState = initState, action: AnyAction): IAppState => {
    switch (action.type) {
        case IS_LOADED: {
            return previousState;
        }
        default: {
            return previousState;
        }
    }
};
