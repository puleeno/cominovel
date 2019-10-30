export interface IEndpoint {
    GetComic: string;
    GetNovel: string;
}

export interface ICominovelProps {
    languages: object;
    endpoints: IEndpoint[];
}
