import { FETCH_COMINOVEL, FETCH_COMINOVEL_FULLFILLED } from './types';

export function fetchCominovel(id: BigInt) {
    return {
        payload: id,
        type: FETCH_COMINOVEL,
    };
}

export function fetchCominovelData(payload: any) {
    return {
        payload,
        type: FETCH_COMINOVEL_FULLFILLED,
    };
}
