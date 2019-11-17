import { ITermType } from "../interfaces/WordPressProps";

const extractTermIds = (terms: ITermType[]) => {
  const ret: number[] = [];
  terms.forEach((term: ITermType) => {
    ret.push(term.id);
  });
  return ret;
};

export default {
  extractTermIds,
};
